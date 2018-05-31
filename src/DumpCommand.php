<?php
namespace amazee\AmazeeioGdprDump;

use machbarmacher\GdprDump\Command\DumpCommand as BaseDumpCommand;
use Ifsnop\Mysqldump\Mysqldump;
use machbarmacher\GdprDump\ConfigParser;
use machbarmacher\GdprDump\MysqldumpGdpr;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DumpCommand extends BaseDumpCommand
{
    protected function configure()
    {
        parent::configure();
        $this->addOption("defaults-extra-file", NULL, InputOption::VALUE_OPTIONAL, "Read this file after the global files are read.");
    }

    protected function getDefaults($extraFile)
    {
        if(empty($extraFile)) {
            $extraFile = getcwd() . "/.gdpr";
        }
        return parent::getDefaults($extraFile);
    }

}