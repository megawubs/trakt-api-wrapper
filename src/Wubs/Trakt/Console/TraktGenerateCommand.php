<?php


namespace Wubs\Trakt\Console;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class TraktGenerateCommand extends Command
{
    public function configure()
    {
        $this->setName("endpoint:generate")
            ->setDescription("Generates the wrapper classes from source")
            ->addArgument(
                'endpoint',
                InputArgument::OPTIONAL,
                'The endpoint you want to generate the wrapper for'
            );


    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $endpoint = $input->getArgument('endpoint');
        $generator = new EndpointGenerator($output);
        if ($endpoint) {
            $output->writeln("Generating endpoint wrapper for: " . $endpoint);
            $generator->generateForEndpoint($endpoint);
            return true;
        }

        $generator->generateAllEndpoints();
        return true;
    }
}