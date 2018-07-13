<?php
namespace App\Command;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DataCommand extends Command
{
    protected $filename = 'storage/data.csv';

    public function __construct()
    {
        if (!file_exists(dirname($this->filename))) {
            mkdir(dirname($this->filename), 0755, true);
        }

        if (!file_exists($this->filename) || !is_readable($this->filename)) { 
            fopen($this->filename, 'w');
        }

        parent::__construct();
    }



    public function tableOutput($rows, OutputInterface $output)
    {
        $table = new Table($output);
        
        $table
            ->setHeaders(['Name', 'Age', 'City'])
            ->setRows($rows);

        $table->render();
    }
}
?>