<?php

namespace App\Services;

use App\Interfaces\CarrierInterface;
use App\Call;
use App\Contact;
use App\Util\ApiClient;

class CarrierChichoService implements CarrierInterface
{

  public function dialContact(Contact $contact)
  {
    return null;
  }

  public function makeCall(): Call
  {
    $call = new Call();
    return $call;
  }

  public function sendSms(string $number, string $body): bool
  {
    $client = new ApiClient();
    $url = 'https://chicho-api.zltech.io/sms/';
    $response = $client->post($url, ['number' => $number, 'body' => $body]);
    $responseData = json_decode($response->getBody(), true);
    if (empty($responseData)) {
      throw new \Exception('Invalid response from API');
    }
    return !!$responseData['success'];
  }
}
