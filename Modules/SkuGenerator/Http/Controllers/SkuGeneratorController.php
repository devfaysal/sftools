<?php

namespace Modules\SkuGenerator\Http\Controllers;

use App\Exports\SkuExport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SkuGeneratorController extends Controller
{
    public function create()
    {
        return view('skugenerator::create');
    }

    public function generate(Request $request)
    {
        $combinations = [[]];
        $data = [];
        foreach ($request->options as $option) {
            $data[] = explode(PHP_EOL, $option);
        }

        $length = count($data);
        for ($count = 0; $count < $length; $count++) {
            $tmp = [];
            foreach ($combinations as $v1) {
                foreach ($data[$count] as $v2) {
                    $tmp[] = array_merge($v1, [trim($v2)]);
                }
            }
            $combinations = $tmp;
        }
        $price = null;
        if($request->priceRow){
            $priceRow = $request->priceRow - 1;
            $price = array_sum(array_column($combinations, $priceRow));
        }
        $skus = [];
        foreach ($combinations as $combination) {
            $sku1 = [];
            $sku2 = [];
            foreach ($combination as $part) {
                if(Str::contains($part, '#')){
                    $parts = explode('#', $part);
                    $sku1[] = trim($parts[0]);
                    $sku2[] = trim($parts[1]);
                }else{
                    $sku1[] = $part;
                }
                
            }
            if(empty($sku2)){
                $skus[] = implode('-', $sku1);
            }else{
                $skus[] = implode('-', $sku1) . ' | ' . implode(' ', $sku2);
            }
        }

        $cacheKey = Str::uuid();
        Cache::put($cacheKey, $skus, now()->addMinutes(60));

        return view('skugenerator::show', [
            'skus' => $skus,
            'cacheKey' => $cacheKey,
            'price' => $price
        ]);
    }

    public function export($cacheKey)
    {
        $fileName = $cacheKey . '.csv';
        return Excel::download(new SkuExport($cacheKey), $fileName);
    }
}
