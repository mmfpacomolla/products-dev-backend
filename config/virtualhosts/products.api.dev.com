server {
        listen 80;
        server_name products.api.dev.com;
        
        root /var/www/html/app;
        index index.html;
        
        location / {
                try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
                include fastcgi_params;
                fastcgi_pass unix:/run/php/php8.2-fpm.sock;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        }
        
        #---- Configuración CORS -----
        add_header 'Access-Control-Allow-Origin' '*' always;
        add_header 'Access-Control-Allow-Methods' 'GET, POST, PUT, DELETE, OPTIONS' always;
        add_header 'Access-Control-Allow-Headers' 'origin, x-requested-with, content-type' always;
        #Comprobamos si es una petición preflight
        if ($request_method = 'OPTIONS') {
                return 204;
        }
        #-----------------------------
}