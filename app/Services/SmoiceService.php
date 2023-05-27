<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class SmoiceService
{
    protected $api_key;

    public function __construct()
    {
        $this->api_key = '31c2c3f42a15fcf0b0e3a29494e53312f1900936';
    }

    public function createCustomer(User $user)
    {
        $request_url = 'https://easy.smoice.com/api/2.0/customers';
        $params = [
            "number" => "SFTOOL" . $user->id,
            "reference" => "SFTOOL" . $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "timeForPayment"=> "6",
        ];

        $response = Http::withToken($this->api_key)->post($request_url, $params);
        if($response->ok() && isset($response['customerId'])){
            $user->update([
                'smoice_customer_id' => $response['customerId']
            ]);
            return true;
        }
        return false;
    }

    public function getCustomer(User $user)
    {
        $request_url = 'https://easy.smoice.com/api/2.0/customers/' . $user->smoice_customer_id;

        $response = Http::withToken($this->api_key)->get($request_url);
        dd($response->json());
    }

    public function searchCustomer(string $search = '')
    {
        $request_url = 'https://easy.smoice.com/api/2.0/customers/search';
        $request_data = [
            'search' => $search,
            'start' => 0,
            'length' => 1,
        ];
        $response = Http::withToken($this->api_key)->get($request_url, $request_data);
        // dd($response->json());
        $customer = $response->json()['customers'][0];
        dd($customer);
    }

}