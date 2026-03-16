#!/bin/bash
set -e

echo ""
echo "🚀  WebGiare Application Container Starting..."
echo "🐘  PHP $(php -v | head -n 1)"
echo "🕸️   Apache Server is warming up..."
echo "🔌  Connecting to Database and Media Services..."
echo "✅  Environment Configured."
echo "🌟  Ready to serve requests!"
echo ""

# Execute the CMD from Dockerfile
exec docker-php-entrypoint apache2-foreground
