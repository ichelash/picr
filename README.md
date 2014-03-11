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

```
The MIT License (MIT)

Copyright (c) 2014 Justin A. S. Bull, 2ndSite Inc. aka FreshBooks

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```