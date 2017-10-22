# Age Exercise 
## What is it?
I was given a task to create a application to calculate my age in hours of as part of job application.   
I went a little overboard and wrote a mini MVC framework & a vue js front end that makes requests to the API :)

## Given Task
![task](https://i.imgur.com/RXOR0Db.png)

## Installation Instructions

1) Copy files to web server & configure database settings in App\config.php.  
2) Create the mysql table from the provided `db.sql` file.  
3) Create a rewrite for to handle the routing. You can use the nginx config below, or create your own.  
4) Done! The site should be live on your server.  

```
    server {
        listen 80;
        server_name _;
        root "/var/www/html/public";
    
        index index.html index.htm index.php;
    
        charset utf-8;
    
        location / {
            try_files $uri $uri/ /index.php?uri=$uri&$args;
        }
    
        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }
    
        access_log off;
        error_log  /var/log/nginx/age.dev-error.log error;
    
        sendfile off;
    
        client_max_body_size 100m;
    
        location ~ \.php$ {
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
            fastcgi_index index.php;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    
            fastcgi_intercept_errors off;
            fastcgi_buffer_size 16k;
            fastcgi_buffers 4 16k;
            fastcgi_connect_timeout 300;
            fastcgi_send_timeout 300;
            fastcgi_read_timeout 300;
        }
    
        location ~ /\.ht {
            deny all;
        }
    }
```
