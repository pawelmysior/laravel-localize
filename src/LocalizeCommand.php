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
        
        $languageFilesInstaller->createLanguageDirectory();
        
        $languageFilesInstaller->downloadLanguageFiles();
        
        $output->writeln('<info>Success!</info>');
    }

    protected function isLaravelApplication()
    {
        return file_exists(getcwd() . '/artisan');
    }
}
