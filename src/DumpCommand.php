<?php
namespace amazee\AmazeeioGdprDump;

use machbarmacher\GdprDump\Command\DumpCommand as BaseDumpCommand;

class DumpCommand extends BaseDumpCommand
{
    protected function getDefaults($extraFile)
    {
        if(empty($extraFile)) {
            $extraFile = getcwd() . "/.gdpr";
        }
        return parent::getDefaults($extraFile);
    }

}