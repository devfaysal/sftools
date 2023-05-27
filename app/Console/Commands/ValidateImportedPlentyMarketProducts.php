<?php

namespace App\Console\Commands;

use App\Models\PlentyMarketProduct;
use App\Services\PlentyMarketService;
use Illuminate\Console\Command;

class ValidateImportedPlentyMarketProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ValidateImportedPlentyMarketProducts';

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
    public function handle()
    {
        $product = PlentyMarketProduct::imported()->first();
        if ($product) {
            $muSite = new PlentyMarketService('mu_varient');
            $muStock = $muSite->getStockByVariationId($product->mu_varient);
            if ($muStock) {
                $muName = $muSite->getProductNameByItemId($muStock->itemId);
            }else{
                $product->update(['status' => PlentyMarketProduct::STATUS_INVALID_MU_ID]);
            }
            $msSite = new PlentyMarketService('ms_varient');
            $msStock = $msSite->getStockByVariationId($product->ms_varient);
            if ($msStock) {
                $msName = $msSite->getProductNameByItemId($msStock->itemId);
            }else{
                $product->update(['status' => PlentyMarketProduct::STATUS_INVALID_MS_ID]);
            }

            $onSite = new PlentyMarketService('on_varient');
            $onStock = $onSite->getStockByVariationId($product->on_varient);
            if ($onStock) {
                $onName = $onSite->getProductNameByItemId($onStock->itemId);
            }else{
                $product->update(['status' => PlentyMarketProduct::STATUS_INVALID_ON_ID]);
            }
            // $this->info("MU name: {$muName}");
            // $this->info("MS name: {$msName}");
            // $this->info("ON name: {$onName}");
            if(trim($muName) == trim($msName) && trim($muName) == trim($onName)){
                $ms_status = $msSite->updateStockByVariationId($product->ms_varient, $muStock->stock);
                $on_status = $onSite->updateStockByVariationId($product->on_varient, $muStock->stock);
            }else{
                $product->update(['status' => PlentyMarketProduct::STATUS_NAME_MISS_MATCH]);
            }

            if(200 == $ms_status && 200 == $on_status){
                $product->product_name = $muName;
                $product->stock = $muStock->stock;
                $product->status = PlentyMarketProduct::STATUS_ACTIVE;
                $product->save();
            }else{
                $product->update(['status' => PlentyMarketProduct::STATUS_STOCK_UPDATE_FAILED]);
            }
        }
    }
}
