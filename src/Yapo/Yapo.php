<?php

namespace Cvar1984\Yapo;

use Cvar1984\Yapo\Exceptions\NotFoundException;
use Cvar1984\Yapo\Exceptions\BadPermissionException;

class Yapo
{
    const STUB_LINUX = 1;
    const STUB_JPEG = 2;
    const STUB_ZIP = 3;
    const STUB_PDF = 4;
    const STUB_MP3 = 5;
    const STUB_MPEG = 6;
    const STUB_LUA = 7;
    const STUB_NES = 8;

    /**
     * write
     *
     * @param string $file
     * @param callable $method
     * @param int $stub
     * @return array
     * @throws NotFoundException
     */
    public static function make(string $file, $method, int $stub = 0)
    {
        if (!file_exists($file)) {
            throw new NotFoundException('Not exist');
        }
        if (!is_file($file)) {
            throw new NotFoundException('Not a file');
        }

        $content = file_get_contents($file);
        $earlySize = strlen($content);
        $earlySum = sha1($content);

        switch ($method) {
            case 'gzdeflate':
                $dohtem = 'gzinflate';
                break;
            default:
                throw new NotFoundException('Method not found');
                break;
        }

        if (strpos($content, '__halt_compiler();')) {
            $action = 'decompress';
            $content = explode('__halt_compiler();', $content)[1];
            $content = $dohtem($content);
        } else {
            $action = 'compress';
            $payload = '$s = "he" . "x2bin";';
            $payload .= '$_ = array($s,"666f70656e","667365656b","746d7066696c65","73747265616d5f6765745f6d6574615f64617461","667772697465","73747265616d5f6765745f636f6e74656e7473","66636c6f7365","5f5f68616c745f636f6d70696c6572");';
            $payload .='$x1 = $_[0];';
            $payload .='$x2 = $x1($_[1]);';
            $payload .='$x3 = $x1($_[2]);';
            $payload .='$x4 = $x1($_[3]);';
            $payload .='$x5 = $x1($_[4]);';
            $payload .='$x6 = $x1($_[5]);';
            $payload .='$x7 = $x1($_[6]);';
            $payload .='$x8 = $x1($_[7]);';
            $payload .='$x9 = $x1($_[8]);';
            $payload .= '$f=$x2(__FILE__,"r");';
            $payload .= '$x3($f,__COMPILER_HALT_OFFSET__);';
            $payload .= '$t=$x4();';
            $payload .= '$u=$x5($t)["uri"];';
            $payload .= '$x6($t,' . $dohtem . '($x7($f)));';
            $payload .= 'include($u);';
            $payload .= '$x8($t);';
            $payload .= '__halt_compiler();';
            $content = $method($content);

            switch ($stub) {
                case 1:
                    $content =
                        "#!/usr/bin/env php\n<?php " . $payload . $content;
                    break;
                case 2: // jpeg
                    $content =
                        hex2bin('FFD8FFE2') . '<?php ' . $payload . $content;
                    break;
                case 3: // zip
                    $content =
                        hex2bin('504B0304') . '<?php ' . $payload . $content;
                    break;
                case 4: // pdf
                    $content = '%PDF-0-1<?php ' . $payload . $content;
                    break;
                case 5: // mp3
                    $content =
                        hex2bin('494433') . '<?php ' . $payload . $content;
                    break;
                case 6: // mpeg
                    $content =
                        hex2bin('1A45DFA3') . '<?php ' . $payload . $content;
                    break;
                case 7: // lua
                    $content =
                        hex2bin('1B4C7561') . '<?php ' . $payload . $content;
                    break;
                case 8: // nes
                    $content =
                        hex2bin('4E45531A') . '<?php ' . $payload . $content;
                    break;
                default:
                    $content = '<?php ' . $payload . $content;
                    break;
            }
        }

        if (!file_put_contents($file, $content)) {
            throw new BadPermissionException('Permission denied');
        }

        $laterSize = strlen($content);
        $laterSum = sha1($content);
        $percentage = (int) (($earlySize * 100) / $laterSize);
        $earlySize = (int) ($earlySize / 1024);
        $laterSize = (int) ($laterSize / 1024);

        return [
            'action' => $action,
            'compress_method' => $method,
            'decompress_method' => $dohtem,
            'percentage' => $percentage,
            'sizeof_bytes_then' => $earlySize,
            'sizeof_bytes_now' => $laterSize,
            'sumof_sha1_then' => $earlySum,
            'sumof_sha1_now' => $laterSum,
        ];
    }
}

