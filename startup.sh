#!/bin/bash

# 1. Copiar configuración de Nginx (Sobreescribimos la default)
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default
service nginx reload

# 2. Caché de Laravel (Vital para producción)
php /home/site/wwwroot/artisan config:cache
php /home/site/wwwroot/artisan route:cache
php /home/site/wwwroot/artisan view:cache

# 3. Enlace simbólico para imágenes (Hotspots)
# 3. Enlace simbólico para imágenes (Hotspots)
php /home/site/wwwroot/artisan storage:link

# 4. DEBUG: Listar archivos para verificar despliegue de assets
ls -R /home/site/wwwroot/public > /home/site/wwwroot/public/debug_assets.txt
chmod 644 /home/site/wwwroot/public/debug_assets.txt

