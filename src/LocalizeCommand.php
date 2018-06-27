<?php

namespace PawelMysior\LaravelLocalize;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocalizeCommand extends Command
{
    protected function configure()
    {
        $this->setName('localize')
            ->setDescription('Localize your Laravel application')
            ->addArgument('lang', InputArgument::REQUIRED, 'Language code');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->isLaravelApplication()) {
            $output->writeLn('<error>Not a Laravel application</error>');

            return 0;
        }

        $languageFilesInstaller = new LanguageFilesInstaller($input->getArgument('lang'));

        $output->write('1. Creating the language directory...');
        $languageFilesInstaller->createLanguageDirectory();
        $output->writeln('<info> success</info>');

        $output->write('2. Downloading the language files...');
        $languageFilesInstaller->downloadLanguageFiles();
        $output->writeln('<info> success</info>');

        $output->writeLn('<info>Successfully installed the "' . $input->getArgument('lang') . '" language files!</info>');
        $output->writeln('<info>Don\'t forget to change the value of the locale key in "config/app.php".</info>');
        $output->writeln('<info>Happy coding!</info>');
    }

    protected function isLaravelApplication()
    {
        return file_exists(getcwd() . '/artisan');
    }
}
