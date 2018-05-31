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
    protected $defaultsExtraFile = null;

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->defaultsExtraFile = $input->getOption('defaults-extra-file'); //store this in us for now ...
        return parent::execute($input, $output);
    }

    protected function configure()
    {
        parent::configure();
        $this->addOption("defaults-extra-file", NULL, InputOption::VALUE_OPTIONAL, "Read this file after the global files are read.");
        $this->addOption("ignore-table", NULL, InputOption::VALUE_OPTIONAL, "Ignore the table given.");
    }

    protected function getDefaults($extraFile)
    {
        //TODO: this logic needs to live elsewhere now ...
        // if(empty($extraFile)) {
        //     $extraFile = getcwd() . "/.gdpr";
        // }
        if(empty($extraFile) && !empty($this->defaultsExtraFile)) {
            $extraFile = $this->defaultsExtraFile;
        }
        return parent::getDefaults($extraFile);
    }

}