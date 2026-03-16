const express = require('express');
const multer = require('multer');
const sharp = require('sharp');
const Minio = require('minio');
const dotenv = require('dotenv');
const path = require('path');

dotenv.config();

const app = express();
const port = process.env.PORT || 3000;

// Multer config: Memory storage
const storage = multer.memoryStorage();
const upload = multer({ storage: storage });

// MinIO Client Configuration
const minioClient = new Minio.Client({
    endPoint: process.env.MINIO_ENDPOINT || 'localhost',
    port: parseInt(process.env.MINIO_PORT) || 9000,
    useSSL: process.env.MINIO_USE_SSL === 'true',
    accessKey: process.env.MINIO_ACCESS_KEY,
    secretKey: process.env.MINIO_SECRET_KEY
});

const BUCKET_NAME = process.env.MINIO_BUCKET_NAME || 'uploads';

// Initialize bucket with retry logic
async function initializeBucket(retries = 10, delay = 5000) {
    for (let i = 0; i < retries; i++) {
        try {
            console.log(`Checking MinIO connection (Attempt ${i + 1}/${retries})...`);
            const bucketExists = await minioClient.bucketExists(BUCKET_NAME);
            
            if (!bucketExists) {
                await minioClient.makeBucket(BUCKET_NAME, 'us-east-1');
                console.log(`Bucket '${BUCKET_NAME}' created successfully.`);
                
                // Set bucket policy to public read
                const policy = {
                    Version: "2012-10-17",
                    Statement: [
                        {
                            Effect: "Allow",
                            Principal: { AWS: ["*"] },
                            Action: ["s3:GetObject"],
                            Resource: [`arn:aws:s3:::${BUCKET_NAME}/*`]
                        }
                    ]
                };
                await minioClient.setBucketPolicy(BUCKET_NAME, JSON.stringify(policy));
                console.log(`Bucket policy set to public read.`);
            } else {
                console.log(`Bucket '${BUCKET_NAME}' already exists.`);
            }
            
            // Connection successful
            console.log('✅  MinIO Connection Established!');
            console.log('📦  Bucket configured and ready for uploads.');
            console.log('🌌  System ready to receive files.\n');
            return; // Success, exit loop
            
        } catch (err) {
            console.error(`❌  MinIO connection failed (Attempt ${i + 1}/${retries}):`, err.code || err.message);
            if (i < retries - 1) {
                console.log(`Waiting ${delay/1000}s before retrying...`);
                await new Promise(resolve => setTimeout(resolve, delay));
            } else {
                console.error('❌  Max retries reached. MinIO is unreachable.');
            }
        }
    }
}

// Upload endpoint
app.post('/upload', upload.single('image'), async (req, res) => {
    try {
        if (!req.file) {
            console.error('No file uploaded in request');
            return res.status(400).json({ error: 'No file uploaded' });
        }

        console.log('Received file:', {
            originalname: req.file.originalname,
            mimetype: req.file.mimetype,
            size: req.file.size
        });

        let folder = '';
        if (req.body.folder) {
            folder = req.body.folder.replace(/^\/+|\/+$/g, '');
        }

        const originalName = path.parse(req.file.originalname).name;
        const ext = path.parse(req.file.originalname).ext.toLowerCase();
        const timestamp = Date.now();
        
        let processedBuffer;
        let fileName;
        let contentType;

        // Check if file is ICO, SVG or other non-processable types (skip processing)
        const skipProcessing = 
            ext === '.ico' || 
            ext === '.svg' || 
            req.file.mimetype.includes('icon') || 
            req.file.mimetype === 'image/svg+xml';

        if (skipProcessing) {
            console.log('Skipping processing for file:', req.file.originalname);
            processedBuffer = req.file.buffer;
            fileName = folder 
                ? `${folder}/${originalName}-${timestamp}${ext}` 
                : `${originalName}-${timestamp}${ext}`;
            contentType = req.file.mimetype || 'application/octet-stream';
        } else {
            // Process other images with Sharp -> WebP
            console.log('Processing image with Sharp:', req.file.originalname);
            fileName = folder 
                ? `${folder}/${originalName}-${timestamp}.webp` 
                : `${originalName}-${timestamp}.webp`;
                
            processedBuffer = await sharp(req.file.buffer)
                .resize({ width: 1200, withoutEnlargement: true })
                .webp({ quality: 80 })
                .toBuffer();
            contentType = 'image/webp';
        }

        // Upload to MinIO
        const metaData = {
            'Content-Type': contentType
        };

        console.log(`Uploading to MinIO bucket '${BUCKET_NAME}' as '${fileName}'`);
        await minioClient.putObject(BUCKET_NAME, fileName, processedBuffer, processedBuffer.length, metaData);

        // Construct public URL
        const publicEndpoint = process.env.MINIO_PUBLIC_ENDPOINT || `http://${process.env.MINIO_ENDPOINT}:${process.env.MINIO_PORT}`;
        const baseUrl = publicEndpoint.replace(/\/$/, '');
        const fileUrl = `${baseUrl}/${BUCKET_NAME}/${fileName}`;

        console.log('Upload success:', fileUrl);
        res.json({
            success: true,
            message: 'Upload successful',
            url: fileUrl,
            filename: fileName
        });

    } catch (err) {
        console.error('Upload error:', err);
        res.status(500).json({ success: false, error: 'Upload failed', details: err.message });
    }
});

// Delete endpoint
app.delete('/delete', express.json(), async (req, res) => {
    try {
        const { filename } = req.body;
        if (!filename) {
            return res.status(400).json({ error: 'Filename is required' });
        }

        console.log(`Deleting file from MinIO: ${filename}`);
        await minioClient.removeObject(BUCKET_NAME, filename);
        
        console.log('Delete success');
        res.json({ success: true, message: 'File deleted' });
    } catch (err) {
        console.error('Delete error:', err);
        res.status(500).json({ success: false, error: err.message });
    }
});

app.get('/health', (req, res) => {
    res.json({ status: 'ok', timestamp: new Date().toISOString() });
});

app.listen(port, () => {
    console.log('\n\n');
    console.log('🚀  Webgiare Media Server is taking off!');
    console.log(`📡  Listening on port ${port}`);
    console.log('⏳  Waiting for MinIO satellite connection...');
    
    // Start initialization immediately (retry logic handles delays)
    initializeBucket();
});
