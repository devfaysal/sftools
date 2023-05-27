<?php
namespace App\Services;

use App\Models\Posting;
use Illuminate\Support\Facades\Http;

class BuchhaltungsbutlerService
{
    protected $client;
    protected $secret;
    protected $api_key;
    protected $base_request_url;

    public function __construct()
    {
        $this->client = 'f.a.u_handelsgesellschaft_mbh';
        $this->secret = 'QCIFOgkblmXZXS5';
        $this->api_key = 'tltmox.a93d1e380bal18ec42b9e753PNDSJXXT041554a0rt59e3ke927bfb692KKIND4M';
        $this->base_request_url = 'https://webapp.buchhaltungsbutler.de/api/v1';
    }

    public function getAccounts()
    {
        $request_url = $this->base_request_url . '/accounts/get';
        $request_data['api_key'] = $this->api_key;
        return Http::withBasicAuth($this->client, $this->secret)
            ->post($request_url, $request_data)
            ->collect();
    }

    public function getPostings()
    {
        $request_url = $this->base_request_url . '/postings/get';
        $request_data = [
            'api_key' => $this->api_key,
            'date_from' => now()->subDays(90)->format('Y-m-d'),
            'date_to' => now()->format('Y-m-d'),
        ];
        return Http::withBasicAuth($this->client, $this->secret)
            ->post($request_url, $request_data)
            ->collect();
    }

    public function addFreePosting(Posting $posting)
    {
        $request_url = $this->base_request_url . '/postings/add/free';
        $request_data = [
            'api_key' => $this->api_key,
            'date' => now()->format('Y-m-d'),
            'postingtext' => $posting->postingtext,
            'amount' => $posting->amount,
            'postingaccount_debit' => $posting->postingaccount_debit,
            'postingaccount_credit' => $posting->postingaccount_credit,
            'vat' => $posting->vat
        ];
        // dd($request_data);
        $response = Http::withBasicAuth($this->client, $this->secret)
            ->post($request_url, $request_data);
        return $response->body();
    }

    public function addZettleTransactionPosting()
    {
        $request_url = $this->base_request_url . '/postings/add/transaction';
        $request_data = [
            'api_key' => $this->api_key,
            'transaction_id_by_customer' => 123,
            'postingaccounts' => [
                44000,
                68550
            ],
            'postingtexts' => [
                'ProductName from Zettel',
                'Zettle Gebühren'
            ],
            'vats' => [
                '19_vat',
                0
            ],
            'amounts' => [
                4100.00,
                -55.35
            ]
        ];
        return Http::dd()->withBasicAuth($this->client, $this->secret)
            ->post($request_url, $request_data);
            // ->collect();
    }

}