# Yet another PHP Obfuscator

this tools able to (de)compress your php code and inject
common file signature to fool webserver uploader
and no installation dependency needed, only single phar executable.
you can download it from [Here](bin/yapo)

## pro tips
Move it to `/usr/local/bin` or save it to `vendor/bin`
using `composer global install`
### command
```sh
yapo yapo:make <compression> <signature> <file>...
```
### single compress
```sh
yapo yapo:make gzdeflate jpeg shell.php
```
### multiple file compress general
```sh
yapo yapo:make gzdeflate lua shell1.php shell2.php
```
### multiple file compress using find
```sh
find ./myproject -type f -iname \*.php -exec yapo yapo:make <..> <..> {} +
```
