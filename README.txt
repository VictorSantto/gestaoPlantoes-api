#GET
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/equals/filter-value/1/order-column/cores.id/order-value/asc/page/1/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/equals/filter-value/1/order-column/cores.id/order-value/asc/page/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/equals/filter-value/1/order-column/cores.id/order-value/asc
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/equals/filter-value/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/not-equals/filter-value/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/like/filter-value/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.cor;cores.id/filter-condition/like;not-equals/filter-value/a;1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/between/filter-value/1%20AND%202
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/less-than/filter-value/2
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/less-equals/filter-value/2
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/more-than/filter-value/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/more-equals/filter-value/1
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/in/filter-value/1,2
http://localhost:8000/getz-api/api/cores/filter-column/cores.id/filter-condition/not-in/filter-value/1,2
http://localhost:8000/getz-api/api/cores/order-column/cores.id/order-value/asc/page/1/1
http://localhost:8000/getz-api/api/cores/order-column/cores.id/order-value/asc/page/1
http://localhost:8000/getz-api/api/cores/order-column/cores.id/order-value/asc
http://localhost:8000/getz-api/api/cores/order-column/cores.id/order-value/desc
http://localhost:8000/getz-api/api/cores/resource/1
http://localhost:8000/getz-api/api/cores

--

#POST
http://localhost:8000/getz-api/api/cores
body -> x-www-form-urlencoded
key -> request
value -> { ... }

--

#PUT
http://localhost:8000/getz-api/api/cores/resource/1
body -> x-www-form-urlencoded
key -> request
value -> { ... }

--

#DELETE
http://localhost:8000/getz-api/api/cores/resource/1

--

#Initial configuration
LoadModule headers_module modules/mod_headers.so
LoadModule rewrite_module modules/mod_rewrite.so
variáveis de ambiente path C:\Sistemas\instantclient;C:\Program Files\VertrigoServ\Php;
liberar permissão de acesso à pasta { Todos: permissão total }

--

#Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

--

#Require JWT vendor
php composer.phar require firebase/php-jwt

--

#Certificate for the CA (Certification authority) -> cacert.pem

#Generating an RSA Private Key Using OpenSSL
openssl genrsa -out private-key.pem 3072

#Creating an RSA Public Key from a Private Key Using OpenSSL
openssl rsa -in private-key.pem -pubout -out public-key.pem

#Optional Creating an RSA Self-Signed Certificate Using OpenSSL
openssl req -new -x509 -key private-key.pem -out cacert.pem -days 360

#Creating a password for the PFX file
openssl pkcs12 -export -inkey private-key.pem -in cacert.pem -out cacert.pfx

--

#Set variables
-Constants.php->BASE_LINK;
-Constants.php->PROJECT;
-src/logic/JWT.php->$publicKey;
-src/logic/JWT.php->$privateKey;