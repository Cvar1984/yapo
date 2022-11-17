# Yet another PHP Obfuscator
[![CodeFactor](https://www.codefactor.io/repository/github/cvar1984/yapo/badge)](https://www.codefactor.io/repository/github/cvar1984/yapo)

this tools able to (de)compress your php shellcode string and inject
common file signature like jpeg to fuck webserver uploader or malware string scanner like what i made before.
no need to install whole shit, just download the single phar executable file and fuck them all.
you can download it from [Here](bin/yapo).

and also your shellcode won't works if the server disable fopen, fseek, fwrite, fclose, and include.
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
yapo make jpeg shell.php
```
### multiple file compress without signature injection
```sh
yapo make whatever shell1.php shell2.php
```
### multiple file compress using find
```sh
find ./myproject -type f -name \*.php -exec yapo make jpeg {} +\;
```
## Deprecated Demo
[![asciicast](https://asciinema.org/a/WpXltv0fDmDRBPVfVmQlaygjh.svg)](https://asciinema.org/a/WpXltv0fDmDRBPVfVmQlaygjh)

## signature
- jpeg: FFD8FFE2
- jpg: FFD8FFE2
- mp4: 1A45DFA3
- mpeg: 1A45DFA3
- luac: 1B4C7561
- lua: 1B4C7561
- zip: 504B0304
- pdf: %PDF-0-1
- mp3: 494433
- nes: 4E45531A
- linux: #!/usr/bin/env php
- shebang: #!/usr/bin/env php
- random string: none

[Full definition](src/Yapo/Yapo.php)

[Compression method](http://www.faqs.org/rfcs/rfc1951.html)

[Contributing](CONTRIBUTING.md)
