<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ZettleService
{
    protected $base_request_url;
    public $token;

    public function __construct()
    {
        $this->token = Cache::get('zettle_access_token');
        $this->base_request_url = 'https://finance.izettle.com/organizations/self/accounts/liquid/transactions';

        if (is_null($this->token)) {
            $grantType = 'urn:ietf:params:oauth:grant-type:jwt-bearer';
            $clientId = '9ed154b5-5f36-11ec-83a1-e14a2217de1f';
            $apiKey = 'eyJraWQiOiIwIiwidHlwIjoiSldUIiwiYWxnIjoiUlMyNTYifQ.eyJpc3MiOiJpWmV0dGxlIiwiYXVkIjoiQVBJIiwiZXhwIjoyNTg2NDUyNjUwLCJzdWIiOiI4NjMwZTVmNi0xMjMwLTExZWMtYjhhZC0zMjE0MmU0MGQ3NjYiLCJpYXQiOjE2Mzk3NDQ4NzQsInJlbmV3ZWQiOmZhbHNlLCJzY29wZSI6WyJSRUFEOlBST0RVQ1QiLCJSRUFEOlVTRVJJTkZPIiwiUkVBRDpGSU5BTkNFIiwiUkVBRDpQVVJDSEFTRSIsIldSSVRFOlBST0RVQ1QiXSwidXNlciI6eyJ1c2VyVHlwZSI6IlVTRVIiLCJ1dWlkIjoiODYzMGU1ZjYtMTIzMC0xMWVjLWI4YWQtMzIxNDJlNDBkNzY2Iiwib3JnVXVpZCI6Ijg2MmY3YmIyLTEyMzAtMTFlYy1iOTQ5LWY0MDI5YTI0ZTAwNSIsInVzZXJSb2xlIjoiT1dORVIifSwidHlwZSI6InVzZXItYXNzZXJ0aW9uIiwiY2xpZW50X2lkIjoiOWVkMTU0YjUtNWYzNi0xMWVjLTgzYTEtZTE0YTIyMTdkZTFmIn0.bbKERd7XV_JYZQEudpVecRfJ1CiMozgiGhlknm8rJ3Em56CzVIm8rLykqlTKDfVuB6MxO5a97EXOnDacalf3yCR58bvmNACkxSW2FJP9BW6iGP0Fj4P8-TiIszVABtLTmq3_wdkO4h0igz2oUeg_yiN5613HU1hxhx48S_N9cS47V9Zx6UXwvCGGeONw8qP5RFWRzYi1HywymmWRR1Ni90xRpb89DvVCEybGsTYmooZ9kHBfQRfH2usbYFi99M0Uhi5xOXWkuomOM79EeeqyW5XOhQlCyHxB3q-8zSarXYXb6tmlxO6XvMHL9x-SRT6_PTak6ytYLJqCeucSMnbrkg';
            $content = sprintf("grant_type=%s&client_id=%s&assertion=%s", $grantType, $clientId, $apiKey);
            $contentType = 'application/x-www-form-urlencoded';
            $url = 'https://oauth.izettle.com/token';
            $response = Http::withBody($content, $contentType)->post($url);
            if (200 === $response->status()) {
                $data = $response->json();
                $accessToken = $data['access_token'];
                Cache::put('zettle_access_token', $accessToken, 7200);
                $this->token = $accessToken;
            }
        }
    }

    public function getTransactions($start_date, $end_date,$limit=30, $offset=0)
    {
        $start_date = $start_date ?? now()->subMonth()->format('Y-m-d');
        $end_date = $end_date ?? now()->format('Y-m-d');
        $response = Http::withToken($this->token)
            ->get($this->base_request_url,[
                'start' => $start_date,
                'end' => $end_date,
                'limit' => $limit,
                'offset' => $offset
            ]);
        return $response->collect()['data'];
    }

    public function getBallance()
    {
        return Http::withToken($this->token)
            ->get('https://finance.izettle.com/organizations/self/accounts/liquid/balance');
    }

    public function getProducts()
    {
        return Http::withToken($this->token)
            ->get('https://products.izettle.com/organizations/862f7bb2-1230-11ec-b949-f4029a24e005/library');
        ///organizations/self/products
    }

    public function getSelf()
    {
        return Http::withToken($this->token)
            ->get('https://oauth.izettle.com/users/self');
    }
}
