<?php

namespace App\Services;

use \Twilio\Rest\Client as TwilioClient;

use App\Interfaces\CarrierInterface;
use App\Call;
use App\Contact;

class CarrierTwilioService implements CarrierInterface
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
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $from = env('TWILIO_PHONE_NUMBER');
    $client = new TwilioClient($sid, $token);
    $client->messages->create(
      $number,
      [
        'from' => $from,
        'body' => $body,
      ]
    );

    return true;
  }
}
