<?php
namespace Milito\QueryFilter\Providers;

use Illuminate\Support\ServiceProvider;
use Milito\QueryFilter\Console\Commands\QueryFilterCreateCommand;

class MilitoQueryFilterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                QueryFilterCreateCommand::class
            ]);
        }

        $this->publishes([
            __DIR__.'/../stubs/query-filter.stub' => base_path('stubs/query-filter.stub')
        ],'query-filter-stubs');

        $this->publishes([
            __DIR__.'/../Console/Commands/QueryFilterCreateCommand.php' => app_path('Console/Commands/QueryFilterCreateCommand.php')
        ],'query-filter-command');

    }

    public function register()
    {

    }
}
