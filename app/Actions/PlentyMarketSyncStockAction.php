<?php
namespace App\Actions;

use App\Models\PlentyMarketProduct;
use App\Services\PlentyMarketService;

class PlentyMarketSyncStockAction
{
    public function __invoke(PlentyMarketProduct $product)
    {
        $muSite = new PlentyMarketService('mu_varient');
        $mu_stock = $muSite->getStockByVariationId($product->mu_varient);

        $msSite = new PlentyMarketService('ms_varient');
        $ms_stock = $msSite->getStockByVariationId($product->ms_varient);

        $onSite = new PlentyMarketService('on_varient');
        $on_stock = $onSite->getStockByVariationId($product->on_varient);

        if ($mu_stock->stock > $product->stock) {
            $updated_base_stock = $mu_stock->stock;
            $mu_status = 200;
            $ms_status = $msSite->updateStockByVariationId($product->ms_varient, $updated_base_stock);
            $on_status = $onSite->updateStockByVariationId($product->on_varient, $updated_base_stock);
        } else {
            $base_stock = $product->stock;
            $mu = $base_stock - $mu_stock->stock;
            $ms = $base_stock - $ms_stock->stock;
            $on = $base_stock - $on_stock->stock;

            $total_reduced = ($mu + $ms + $on);
            $updated_base_stock = ($base_stock - $total_reduced);
            if($updated_base_stock <= 0){
                return [
                    'mu_status' => null,
                    'ms_status' => null,
                    'on_status' => null
                ];
            }
            $mu_status = $muSite->updateStockByVariationId($product->mu_varient, $updated_base_stock);
            $ms_status = $msSite->updateStockByVariationId($product->ms_varient, $updated_base_stock);
            $on_status = $onSite->updateStockByVariationId($product->on_varient, $updated_base_stock);
        }
        $product->stock = $updated_base_stock;
        $product->save();

        return [
            'mu_status' => $mu_status,
            'ms_status' => $ms_status,
            'on_status' => $on_status
        ];
    }
}