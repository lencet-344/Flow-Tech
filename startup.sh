#!/bin/bash
cp /etc/nginx/sites-available/default /etc/nginx/sites-available/default.bak
sed -i 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /etc/nginx/sites-available/default
sed -i 's|index  index.php index.html index.htm;|index  index.php index.html index.htm;\n        try_files $uri $uri/ /index.php?$args;|g' /etc/nginx/sites-available/default
service nginx reload
cd /home/site/wwwroot
php artisan storage:link
php artisan optimize:clear
