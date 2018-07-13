<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadDataCommand extends DataCommand
{

    protected function configure()
    {
        $this
            ->setName('data:read')
            ->setDescription('Read the contents of a CSV file.')
            ->setHelp('This command allows reading of data from a CSV file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rows = $this->parseCSV();

        if (count($rows) > 0) {
            return $this->tableOutput($rows, $output);
        }

        $output->writeln('No entries found. Add some using the data:write command.');
    }   

    public function parseCSV()
    {   
        // Short way of parsing csv by mapping the array 
        // and calling str_getcsv on each entry
        return array_map('str_getcsv', file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        
    }
}
?>