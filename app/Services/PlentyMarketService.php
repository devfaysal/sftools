<?php
namespace App\Services;

use App\Dto\PlentyMarketProductStock;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PlentyMarketService
{
    protected $sites = [
        'mu_varient' => [
            'baseUrl' => 'https://www.matratzenunion.de/rest',
            'username' => 'n.przybilla',
            'password' => 'Przybilla1!',
            'warehouse' => '103'
        ],
        'ms_varient' => [
            'baseUrl' => 'https://www.markenschlaf.de/rest',
            'username' => 'n.przybilla',
            'password' => 'Przybilla1!',
            'warehouse' => '105'
        ],
        'on_varient' => [
            'baseUrl' => 'https://www.onletto.de/rest',
            'username' => 'n.przybilla',
            'password' => 'Przybilla1!',
            'warehouse' => '104'
        ]
    ];
    public $baseUrl;
    public $username;
    public $password;
    public $warehouse;
    public $accessToken;

    public function __construct($site)
    {
        $this->baseUrl = $this->sites[$site]['baseUrl'];
        $this->username = $this->sites[$site]['username'];
        $this->password = $this->sites[$site]['password'];
        $this->warehouse = $this->sites[$site]['warehouse'];
        $this->accessToken = Cache::get($this->baseUrl);

        if (is_null($this->accessToken)) {
            $url = $this->baseUrl . '/login';
            $content = [
                'username' => $this->username,
                'password' => $this->password,
            ];
            $response = Http::timeout(20)->retry(2, 1000)->post($url, $content);
            if (200 === $response->status()) {
                $data = $response->json();
                $accessToken = $data['accessToken'];
                $expiresIn = $data['expiresIn'];
                Cache::put($this->baseUrl, $accessToken, $expiresIn);
                $this->accessToken = $accessToken;
            }
        }
    }

    public function getStockByVariationId($variationId)
    {
        $url = $this->baseUrl . "/stockmanagement/warehouses/{$this->warehouse}/stock/storageLocations";
        $data = ['variationId' => $variationId];
        $response = Http::timeout(15)->retry(2, 1000)->withToken($this->accessToken)->get($url,$data);
        if (200 === $response->status()) {
            $data = $response->json();
            if(empty($data['entries'])){
                return null;
            }
            return new PlentyMarketProductStock($data['entries'][0]);
        }
    }

    public function getProductNameByItemId($itemId)
    {
        $url = $this->baseUrl . "/items";
        $data = ['id' => $itemId];
        $response = Http::timeout(15)->retry(2, 1000)->withToken($this->accessToken)->get($url, $data);
        if (200 === $response->status()) {
            $data = $response->json();
            return $data['entries'][0]['texts'][0]['name1'];
        }
    }

    public function updateStockByVariationId($variationId, $updated_base_stock)
    {
        $url = $this->baseUrl. "/stockmanagement/warehouses/{$this->warehouse}/stock/correction";
        $data = [
            "corrections" => [
                [
                    "variationId" => $variationId,
                    "reasonId" => 325,
                    "quantity" => $updated_base_stock,
                    "storageLocationId" => 0
                ]
            ]
        ];

        $response = Http::timeout(15)->retry(2, 1000)->withToken($this->accessToken)->put($url, $data);
        return $response->status();
    }

}