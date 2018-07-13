<?php
namespace App\Command;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WriteDataCommand extends DataCommand
{

    protected function configure()
    {
        $this
            ->setName('data:write')
            ->setDescription('Write an entry to a CSV file.')
            ->setHelp("This command allows writing data to a CSV file. \nUsage: ./console data:write <key> <value>");

        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the new entry')
            ->addArgument('age', InputArgument::OPTIONAL, 'The age of the new entry')
            ->addArgument('location', InputArgument::OPTIONAL, 'The current location of the new entry');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input = $this->processInput($input, $output);

        $entry = [$input];

        $this->appendToCSV($entry);

        $output->writeln(sprintf('<info>Added entry to csv with following data: %s', implode(', ', $input).'</info>'));
        
    }

    public function appendToCSV($entry)
    {
        $fp = fopen($this->filename, 'a');

        foreach($entry as $field){
            fputcsv($fp, $field);
        }

        fclose($fp);
    }

    /**
     * Get values from input arguments, or ask interactively.
     * 
     * @param InputInterface  $input  The Symfony InputInterface
     * @param OutputInterface $output The Symfony OutputInterface
     * 
     * @return array          $entry   The processed entry
     */
    public function processInput($input, $output)
    {
        $helper = $this->getHelper('question');

        if (!$name = $input->getArgument('name')) {
            $name = $helper->ask(
                $input, 
                $output, 
                new Question("What is the name of the person you would like to add? \n")
            );
        }

        if (!$age = $input->getArgument('age')) {
            $age = $helper->ask(
                $input, 
                $output, 
                new Question("What is the age of the person which you would like to add? \n")
            );
        }

        if (!$location = $input->getArgument('location')) {
            $location = $helper->ask(
                $input, 
                $output, 
                new Question("What is the location of the person which you would like to add? \n")
            );
        }

        return [$name, $age, $location];
    }
}
?>