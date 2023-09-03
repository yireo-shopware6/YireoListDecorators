<?php declare(strict_types=1);

namespace Yireo\ListDecorators\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;

#[AsCommand(name: 'debug:decorators', description: 'List all decorators')]
class ListDecoratorsCommand extends Command
{
    public function __construct(
        private iterable $serviceDecorators,
        string $name = null
    ) {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setHeaders([
            'Service decorator',
            'Original service'
        ]);

        foreach ($this->serviceDecorators as $serviceDecorator) {
            $table->addRow([
               get_class($serviceDecorator),
                $this->getOriginalClass(get_class($serviceDecorator))
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }

    private function getOriginalClass(string $className): string
    {
        $parentClassName = get_parent_class($className);
        if ($parentClassName) {
            return $parentClassName;
        }

        $interfaceNames = class_implements($className);
        if (!empty($interfaceNames)) {
            return array_pop($interfaceNames);
        }

        return '';
    }
}