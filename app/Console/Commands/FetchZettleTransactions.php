<?php

namespace App\Console\Commands;

use App\Services\ZettleService;
use Illuminate\Console\Command;

class FetchZettleTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FetchZettleTransactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ZettleService $zettleService)
    {
        return 0;
    }
}
