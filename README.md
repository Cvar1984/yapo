# Yet another PHP Obfuscator

this tools able to (de)compress your php code and inject
common file signature to fool webserver uploader
and no dependency needed, only single phar executable.
you can download it from [Here](bin/yapo)

## pro tips
Move it to `/usr/local/bin` or save it to `vendor/bin`
using `composer global install`
### single compress
```sh
yapo file.php
```
### multi compress
```sh
yapo $(find ./myproject -type f -name "*.php")
```
