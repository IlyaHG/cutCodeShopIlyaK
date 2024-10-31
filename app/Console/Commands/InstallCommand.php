<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'shop:install';


    protected $description = 'Installation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        $this->call('key:generate');
        $this->call('storage:link');
        $this->call('migrate');
        $this->call('db:seed');

        return self::SUCCESS;
    }
}
