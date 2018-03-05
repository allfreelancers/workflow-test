<?php

namespace AppBundle\Command;

use AppBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WorkflowCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('workflow:test')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $item = new Item();
        $item->setTitle('test');

        $this->getContainer()->get('workflow.item')->apply($item, 'publish');

        $em->persist($item);
        $em->flush();

        $output->writeln('Command result.');
    }

}
