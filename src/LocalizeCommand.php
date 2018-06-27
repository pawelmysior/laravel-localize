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
        $output->writeln($input->getArgument('lang'));
    }
}
