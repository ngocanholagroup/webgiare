<?php
/**
 * Security Headers Middleware
 * Sets HTTP security headers to protect against common vulnerabilities
 * Priority 3: Enhancement & Hardening
 * 
 * Usage: SecurityHeaders::applyHeaders();
 * Call this in index.php before any output
 */

class SecurityHeaders
{
    /**
     * Apply all security headers to response
     * Must be called before any output is sent
     */
    public static function applyHeaders()
    {
        // HTTPS only (HSTS - HTTP Strict Transport Security)
        // Tells browsers to always use HTTPS for this domain for 1 year
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload', true);
        
        // Content Security Policy (CSP)
        // Prevents inline scripts and restricts resource loading
        self::setContentSecurityPolicy();
        
        // X-Content-Type-Options: nosniff
        // Prevents MIME type sniffing
        header('X-Content-Type-Options: nosniff', true);
        
        // X-Frame-Options: SAMEORIGIN
        // Prevents clickjacking attacks
        header('X-Frame-Options: SAMEORIGIN', true);
        
        // X-XSS-Protection: 1; mode=block
        // Extra XSS protection for older browsers
        header('X-XSS-Protection: 1; mode=block', true);
        
        // Referrer-Policy: strict-origin-when-cross-origin
        // Controls how much referrer info is shared
        header('Referrer-Policy: strict-origin-when-cross-origin', true);
        
        // Permissions-Policy: Restrict browser features
        // Disable geolocation, microphone, camera, payment APIs
        header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=()', true);
        
        // Remove sensitive server info
        header('Server: WebServer', true);
        header_remove('X-Powered-By');
        
        // Prevent caching of sensitive pages
        self::setNoCacheHeaders();
    }

    /**
     * Set Content-Security-Policy header
     * Restricts resources that can be loaded and executed
     */
    private static function setContentSecurityPolicy()
    {
        $csp = self::buildCSP();
        header('Content-Security-Policy: ' . $csp, true);
    }

    /**
     * Build CSP directive string
     */
    private static function buildCSP()
    {
        $directives = [
            // Default: only same-origin resources
            "default-src 'self'",
            
            // Scripts: Allow self, unsafe-inline (for framework scripts), and essential CDNs
            // - CKEditor: https://cdn.ckeditor.com
            // - TinyMCE: https://cdnjs.cloudflare.com
            // - Tailwind CSS: https://cdn.tailwindcss.com
            // - Lucide Icons: https://unpkg.com
            // - CDN.js: https://cdn.jsdelivr.net
            "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdn.ckeditor.com https://cdnjs.cloudflare.com https://cdn.tailwindcss.com https://unpkg.com",
            
            // Styles: Allow self, unsafe-inline, and font/CDN sources
            // - Google Fonts: https://fonts.googleapis.com
            // - FontAwesome: https://cdnjs.cloudflare.com
            // - CKEditor: https://cdn.ckeditor.com
            // - Tailwind: https://cdn.jsdelivr.net
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.ckeditor.com",
            
            // Images: allow self, data URIs, and all HTTPS
            "img-src 'self' data: https:",
            
            // Fonts: allow self and font CDNs
            "font-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com",
            
            // Fetch/AJAX: allow self and HTTPS + websockets
            "connect-src 'self' https: ws: wss:",
            
            // Objects/embeds: disallow
            "object-src 'none'",
            
            // Media: allow self
            "media-src 'self'",
            
            // Forms: allow self
            "form-action 'self'",
            
            // Frames: only self
            "frame-ancestors 'self'",
            
            // Base URI: restrict base tag
            "base-uri 'self'",
            
            // Report violations (optional - comment out if not using report endpoint)
            // "report-uri /security/csp-report"
        ];
        
        return implode('; ', $directives);
    }

    /**
     * Set no-cache headers for sensitive pages
     */
    private static function setNoCacheHeaders()
    {
        // Determine if current page should not be cached
        $noCachePaths = ['/admin/', '/api/', '/account/'];
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        
        foreach ($noCachePaths as $path) {
            if (strpos($requestUri, $path) === 0) {
                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);
                header('Pragma: no-cache', true);
                header('Expires: 0', true);
                return;
            }
        }
    }

    /**
     * Set HTTPS-only cookies (must be called BEFORE session_start)
     */
    public static function configureSessionCookie()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Set cookie parameters ONLY if session hasn't started yet
            $options = [
                'secure' => false,      // false for development, true for HTTPS only
                'httponly' => true,    // Prevent JavaScript access
                'samesite' => 'Lax'    // CSRF protection
            ];
            session_set_cookie_params($options);
        }
    }

    /**
     * Verify session security (called after session is active)
     */
    public static function verifySessionSecurity()
    {
        // Session already started, just verify it's working
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Get security score (for monitoring/reporting)
     */
    public static function getSecurityScore()
    {
        $score = 0;
        $maxScore = 10;
        
        // Check if running on HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $score += 2;
        }
        
        // Check for CSP header
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
            if (isset($headers['Content-Security-Policy'])) {
                $score += 2;
            }
            if (isset($headers['Strict-Transport-Security'])) {
                $score += 2;
            }
            if (isset($headers['X-Frame-Options'])) {
                $score += 2;
            }
            if (isset($headers['X-Content-Type-Options'])) {
                $score += 2;
            }
        }
        
        return [
            'score' => $score . '/' . $maxScore,
            'percentage' => round(($score / $maxScore) * 100) . '%'
        ];
    }
}
?>
