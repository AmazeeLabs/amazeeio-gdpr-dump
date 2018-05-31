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
        //TODO: some of this needs to be raised into parent
        //for now we overwrite it _all_
        $defaultsFiles[] = '/etc/my.cnf';
        $defaultsFiles[] = '/etc/mysql/my.cnf';
        $defaultsFiles[] = getcwd() . "/.gdpr";
        if ($extraFile) {
          $defaultsFiles[] = $extraFile;
        }

        if(!empty($this->defaultsExtraFile)) {
            $defaultsFiles[] = $this->defaultsExtraFile;
        }

        if ($homeDir = getenv('MYSQL_HOME')) {
          $defaultsFiles[] = "$homeDir/.my.cnf";
          $defaultsFiles[] = "$homeDir/.mylogin.cnf";
        }
        
        $config = new ConfigParser();
        foreach ($defaultsFiles as $defaultsFile) {
          if (is_readable($defaultsFile)) {
            $config->addFile($defaultsFile);
          }
        }
        return $config->getFiltered(['client', 'mysqldump']);
    }

}