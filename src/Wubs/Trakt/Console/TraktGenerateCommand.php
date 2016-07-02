<?php

namespace Wubs\Trakt\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Wubs\Trakt\Console\Generators\EndpointGenerator;

class TraktGenerateCommand extends Command
{
    public function configure()
    {
        $this->setName("wrapper:generate")
            ->setDescription("Generates the wrapper classes from source")
            ->addArgument(
                'endpoint',
                InputArgument::OPTIONAL,
                'The endpoint you want to generate the wrapper for'
            )->addOption(
                "force",
                '-f',
                InputOption::VALUE_NONE,
                "Force generation, assumes yes on all questions."
            )
            ->addOption(
                "delete",
                '-d',
                InputOption::VALUE_NONE,
                "Delete all files and folders before regenerating. Useful for when names are changed."
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new EndpointGenerator($input, $output, new QuestionHelper(), $input->getOption("force"), $input->getOption("delete"));

        if ($endpoint = $input->getArgument('endpoint')) {
            $output->writeln("Generating endpoint wrapper for: " . $endpoint);
            $generator->generateForEndpoint($endpoint);
            return true;
        }

        $generator->generateAllEndpoints();
        return true;
    }
}
