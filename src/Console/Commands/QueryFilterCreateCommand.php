<?php
namespace Milito\QueryFilter\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class QueryFilterCreateCommand extends  GeneratorCommand
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:query-filter';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new query filter class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'QueryFilter';

    protected function alreadyExists($rawName): bool
    {
        $class = $this->qualifyClass($rawName);

        return class_exists($class);
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments(): array
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null
            ],
        ];
    }

    public function getOptions(): array
    {
        return [
            [
                '--array',
                '-a',
                null,
                'If set this option, it will be create an array filter class',
            ]
        ];
    }

    protected function getStub(): string
    {
        if ($this->option("array")) {
            return __DIR__.'/../../stubs/array-query-filter.stub';
        }else{
            return __DIR__.'/../../stubs/query-filter.stub';
        }
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace. '\\Filters';
    }

}

