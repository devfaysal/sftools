<?php

namespace App\Console\Commands;

use App\Actions\PlentyMarketSyncStockAction;
use App\Models\PlentyMarketProduct;
use Illuminate\Console\Command;

class PlentyMarketSyncStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PlentyMarketSyncStock';

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
    public function handle(PlentyMarketSyncStockAction $plentyMarketSyncStockAction)
    {
        PlentyMarketProduct::active()->chunk(20, function ($products) use ($plentyMarketSyncStockAction){
            foreach ($products as $product) {
                $plentyMarketSyncStockAction($product);
            }
        });
    }
}
