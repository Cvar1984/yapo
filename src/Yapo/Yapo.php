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
    protected const COMPILER_TOKEN = '__Halt_CompiLer/* Y */ /* A */ /* P */ /* O */ /** */();';

    /**
     * Obfuscate / Deobfuscate from given filepath
     *
     * @param string $file
     * @param int $stub
     * @return array
     * @throws NotFoundException
     */
    public static function make(string $file, int $stub = 0)
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


        if (strpos($content, Yapo::COMPILER_TOKEN)) {
            $action = 'decompress';
            $content = explode(Yapo::COMPILER_TOKEN, $content)[1];
            $content = gzinflate($content);
        } else {
            $action = 'compress';
            $payload = '$_ = ARraY("uhex","666f7" . "0656e","6673" . "65656b","746d706" . "6696c65","73747265616d5" . "f6765745f6d6" . "574615f64617461","6677". "72697465","73747265616d" . "5f6765745f" . "636f6e74656e7473","66636" . "c6f7365","5f5f68616c74" . "5f636f6d70696c6572","677a696e6" . "66c617465","686578646563");';
            $payload .= '$x1=$_[0];';
            $payload .= '$x2=$x1($_[1]);';
            $payload .= '$x3=$x1($_[2]);';
            $payload .= '$x4=$x1($_[3]);';
            $payload .= '$x5=$x1($_[4]);';
            $payload .= '$x6=$x1($_[5]);';
            $payload .= '$x7=$x1($_[6]);';
            $payload .= '$x8=$x1($_[7]);';
            $payload .= '$x9=$x1($_[8]);';
            $payload .= '$x10=$x1($_[9]);';
            $payload .= '$x11=$x1($_[10]);';
            //$payload = 'function hex($n){$y="";for($i=0;$i<strlen($n);$i++){$y.=dechex(ord($n[$i]));}return $y;}';
            $payload .= 'FuNctIon uhex /*'. bin2hex(random_bytes(2)) .'*/($y){$n="";for($i=0;$i<strLen/*' .bin2hex(random_bytes(3)) . '*/($y)-1;$i+=2){$n.=CHR/*' .bin2hex(random_bytes(4)) . '*/(hExDec($y[$i].$y[$i+1]));}return $n;}';
            $payload .= '$f=$x2(__FILE__,"r");';
            $payload .= '$x3($f,__COMPILER_HALT_OFFSET__);';
            $payload .= '$t=$x4();';
            $payload .= '$u=$x5($t);';
            $payload .= '$u=$u["uri"];';
            $payload .= '$x6($t,$x10($x7($f)));';
            $payload .= 'rEquiRe($u);';
            $payload .= '$x8($t);';
            $payload .= Yapo::COMPILER_TOKEN;
            $content = gzdeflate($content);

            switch ($stub) {
                case Yapo::STUB_LINUX:
                    $content =
                        "#!/usr/bin/env php\n<?php " . $payload . $content;
                    break;
                case Yapo::STUB_JPEG:
                    $content =
                        hex2bin('FFD8FFE2') . '<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_ZIP:
                    $content =
                        hex2bin('504B0304') . '<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_PDF:
                    $content = '%PDF-0-1<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_MP3:
                    $content =
                        hex2bin('494433') . '<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_MPEG:
                    $content =
                        hex2bin('1A45DFA3') . '<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_LUA:
                    $content =
                        hex2bin('1B4C7561') . '<?php ' . $payload . $content;
                    break;
                case Yapo::STUB_NES:
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
            'percentage' => $percentage,
            'sizeof_bytes_then' => $earlySize,
            'sizeof_bytes_now' => $laterSize,
            'sumof_sha1_then' => $earlySum,
            'sumof_sha1_now' => $laterSum,
        ];
    }
}
