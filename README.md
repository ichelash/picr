picr
====

Imgur for FreshBooks

### Requirements ###
- [Composer](https://getcomposer.org)

### Installation ###
- `php composer.phar install`
- In `Symfony/` run `php app/console doctrine:schema:update --force`

### Deployment to Production ###
- Get this code onto the server (git clone?)
- `cd` into `Symfony/`
- Configure `app/config/parameters.yml` appropriately
- `php composer.phar install --no-dev --optimize-autoloader`
- `php app/console cache:clear --env=prod --no-debug`
- `php app/console doctrine:schema:update --force`

### Example Apache Vhost ###

```
<VirtualHost *:9080>
  ServerName picr.freshbooksdev.com
  DocumentRoot "/home/fresh/picr/Symfony/web"
  <Directory "/home/fresh/picr/Symfony/web">
    AllowOverride All
    Order allow,deny
    Allow from all
  </Directory>


  ErrorLog /var/log/httpd/picr_error.log
  CustomLog /var/log/httpd/picr_access.log combined
</VirtualHost>
```