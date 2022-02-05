<?php

namespace Cvar1984\Yapo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use Cvar1984\Yapo\Yapo;

/**
 * Class: MakeCommand
 *
 * @see Command
 */
class MakeCommand extends Command
{
    /**
     * defaultName
     *
     * @var string
     */
    protected static $defaultName = 'make';

    /**
     * configure
     *
     */
    protected function configure()
    {
        $this->setDescription('Compress given file');
        $this->setHelp('No help');

        $this->addArgument(
            'compression',
            InputArgument::REQUIRED,
            'Compression method'
        );

        $this->addArgument(
            'signature',
            InputArgument::REQUIRED,
            'Injection file signature'
        );

        $this->addArgument(
            'file',
            InputArgument::IS_ARRAY | InputArgument::REQUIRED,
            'Compress given file, separate with space'
        );
    }
    /**
     * execute
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $input->getArgument('file');
        $compression = $input->getArgument('compression');
        $stub = $input->getArgument('signature');

        switch ($stub) {
            case 'jpeg':
            case 'jpg':
                $stub = Yapo::STUB_JPEG;
                break;
            case 'mp4':
            case 'mpeg':
                $stub = Yapo::STUB_MPEG;
                break;
            case 'luac':
            case 'lua':
                $stub = Yapo::STUB_LUA;
                break;
            case 'zip':
                $stub = Yapo::STUB_ZIP;
                break;
            case 'pdf':
                $stub = Yapo::STUB_PDF;
                break;
            case 'mp3':
                $stub = Yapo::STUB_MP3;
                break;
            case 'nes':
                $stub = Yapo::STUB_NES;
                break;
            case 'linux':
            case 'shebang':
                $stub = Yapo::STUB_LINUX;
                break;
            default:
                $stub = false;
        }

        $io = new SymfonyStyle($input, $output);

        if (is_array($files)) {
            $io->progressStart(count($files));

            foreach ($files as $file) {
                $io->progressAdvance();
                $results = Yapo::make($file, $compression, $stub);
            }

            $io->progressFinish();
            $output->writeln("<info>Action: {$results['action']}</info>");
            $output->writeln(
                "<info>size: {$results['sizeof_bytes_now']} bytes</info>"
            );
            $output->writeln(
                "<info>Percentage: {$results['percentage']}%</info>"
            );
            return 0;
        }
        return 1;
    }
}
