<?php

namespace App\Util;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ApiClient extends Client
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get(string $url): ResponseInterface
    {
        return $this->request('GET', $url);
    }

    public function post(string $url, array $data): ResponseInterface
    {
        return $this->request('POST', $url, ['json' => $data]);
    }
}
