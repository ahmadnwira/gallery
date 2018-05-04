# Gallery

 php web application allow user to share like photos.

## Apacahe settings for routing

RewriteEngine on

`Redirect Trailing Slashes If Not A Folder`

RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)/$ /$1 [L,R=301]

`Handle Front Controller`

RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^ index.php [L]