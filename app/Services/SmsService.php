<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $username;
    protected $password;
    protected $request_url;
    protected $sender;

    public function __construct()
    {
        $this->username = 'KNA3T2';    // hier bitte Ihre Kundennummer eintragen
        $this->password = 'uD6XG73oqVYgWM3W';    // hier bitte das im Menüpunkt "Extras - Versandschnittstelle" definierte Passwort eintragen
        $this->request_url = 'http://api.mobile-marketing-system.de/send_sms.php';
        $this->sender = '+491632587799';
    }

    public function send($recipient, $message, $sender=null)
    {
        return 200;
        $params = [
            'username'  => $this->username,
            'password'  => $this->password,
            'text'      => $message,
            'recipient' => $recipient,
            'sender'    => $sender ?? $this->sender,
        ];
        $response = Http::get($this->request_url, $params);
        return $response->ok();
    }
}
