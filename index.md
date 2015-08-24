---
layout: main
# title: *none*
---

# {{ site.title }}

The following is a suggested [nginx](https://nginx.org/) web-server configuration block. If you clone the repository somewhere else or wish to use another hostname, change the configuration.

###### /etc/nginx/sites-available/local.functionalstoneware.conf

    server {
        root /srv/hosts/local.functionalstoneware/www;
        server_name functionalstoneware.local;

        rewrite /about /about.php;
        rewrite /contact /contact.php;
        rewrite /gallery /gallery.php;
        rewrite ^/shop/([0-9]+)$ /shop.php?id=$1 break;
        rewrite /shop /shop.php;
        rewrite /data /../includes/data.php;
    }

Don't forget to change your hosts file (`/etc/hosts` in *NIX systems) to point the hostname to the right IP address.

###### /etc/hosts

    functionalstoneware.local  127.0.0.1

You'll also want something like the following in your server block. Place this after the rewrites and before the closing brace (`}`). This forwards requests to any PHP scripts to a UNIX socket that PHP-FPM should be listening on.

###### /etc/nginx/sites-available/local.functionalstoneware.conf

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
