#!/bin/bash

# Copiar configuración de Nginx
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-enabled/default

# Reiniciar Nginx
service nginx reload

# Ejecutar migraciones
php /home/site/wwwroot/artisan migrate --force

# Limpiar y cachear
php /home/site/wwwroot/artisan config:cache
php /home/site/wwwroot/artisan route:cache
php /home/site/wwwroot/artisan view:cache

cd /home/site/wwwroot && npm ci
npm run build

php /home/site/wwwroot/artisan storage:link