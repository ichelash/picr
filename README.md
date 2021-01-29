picr
====

![App Screenshot](http://i.imgur.com/LsVPJWi.png)

What and Why
------------

Because sometimes you want to share images that are internal, and shouldn't be uploaded for the world to see.

Picr is a dead simple, drag-and-drop upload image sharing webapp akin to Imgur. Right now it's __very, very basic__ so don't expect the world of it. But it definitely makes it easy to share internal images within a company.

This is something I built for [FreshBooks](https://www.freshbooks.com/) during one of our many hackoffs.

The Technical Bits
------------------

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

### Install PHP 5.6
 sudo apt-get install python-software-properties
 sudo add-apt-repository ppa:ondrej/php
 sudo apt-get update
 sudo apt-get install -y php5.6 php5.6-intl


### Install Apache2
 apt-get install apache2 libapache2-mod-php5
 
 ### Setup Symfony Installer
 sudo curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
 sudo chmod a+x /usr/local/bin/symfony 
 
 ### Create New Symfony 2 Application
 cd /var/www
 symfony new myproj 2.8
 
 ### Example Apache Vhost ###

```
<VirtualHost *:9080>
  ServerName picr.yourinternaldomain.com
  DocumentRoot "/home/foobar/picr/Symfony/web"
  <Directory "/home/foobar/picr/Symfony/web">
    AllowOverride All
    Order allow,deny
    Allow from all
  </Directory>


  ErrorLog /var/log/httpd/picr_error.log
  CustomLog /var/log/httpd/picr_access.log combined
</VirtualHost>
```

### License ###

Copyright 2014 by [Justin A. S. Bull](https://www.justinbull.ca) and 2ndSite Inc. aka [FreshBooks](https://www.freshbooks.com), and licensed under the MIT License. See included
[LICENSE](LICENSE) file for details
