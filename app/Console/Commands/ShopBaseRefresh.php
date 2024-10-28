<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShopBaseRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:dbrefresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Shop Mysql Base';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->call('migrate:rollback');
        $this->call('migrate');
        $this->call('db:seed');
        return self::SUCCESS;
    }
}
