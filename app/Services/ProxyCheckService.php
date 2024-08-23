<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class ProxyCheckService
{

    private const PROXY_URL = 'https://proxycheck.io/v2/';

    /**
     * @var \GuzzleHttp\Client
     */
    private Client $client;

    public string $ip;

    public string $status;

    private string $country = '';

    private string $proxy = '';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct(string $ip)
    {
        $this->ip     = $ip;
        $this->client = new Client();
        $this->collectData();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function collectData(): void
    {
        $url      = self::PROXY_URL.$this->ip.'?'.http_build_query(['asn' => 1, 'vpn' => 1]);
        $response = $this->client->get($url);
        $data     = json_decode($response->getBody()->getContents(), true);

        $this->status = Arr::get($data, 'status');

        if($this->status == 'ok'){
            $this->country = $data[$this->ip]['country'];
            $this->proxy = $data[$this->ip]['proxy'];
        }
    }

    public function getProxy(): string
    {

        return $this->proxy;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

}
