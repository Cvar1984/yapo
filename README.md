# Yet another PHP Obfuscator

this tools able to (de)compress your php shellcode string and inject
common file signature like jpeg to fuck webserver uploader or malware string scanner like what i made before.
no need to install whole shit, just download the single phar executable file and fuck them all.
you can download it from [Here](bin/yapo)
> no need to download suck eval shellcodes, just use this tools to rule them all.
> your shellcode won't works if the server disable fopen, fseek, fwrite, fclose, and include.
> DISCLAIMER use eval to obfuscate is gay
## pro tips
Move it to `/usr/local/bin` or save it to `vendor/bin`
using `composer global install cvar1984/yapo`
### command
```sh
yapo make <compression> <signature> <file>...
```
### single compress
```sh
yapo make gzdeflate jpeg shell.php
```
### multiple file compress without signature injection
```sh
yapo make gzdeflate whatever shell1.php shell2.php
```
### multiple file compress using find
```sh
find ./myproject -type f -name \*.php -exec yapo make gzdeflate jpeg {} +\;
```
# Deprecated Demo
![Asciinema](https://asciinema.org/a/WpXltv0fDmDRBPVfVmQlaygjh)
