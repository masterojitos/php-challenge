<?php

namespace App\Services;

use GuzzleHttp\Client;

use App\Contact;
use App\Util\ApiClient;

class ContactService
{

	public static function findByName(string $name): Contact
	{
		$url = 'https://chicho-api.zltech.io/contacts/?name=' . urlencode($name);
		$client = new ApiClient();
		$response = $client->get($url);
		$responseData = json_decode($response->getBody(), true);
		if (empty($responseData)) {
			throw new \Exception('Invalid response from API');
		}
		$contact = new Contact($responseData['name'], $responseData['phone']);
		return $contact;
	}

	public static function validateNumber(string $number): bool
	{
		if (strlen($number) !== 9 || !ctype_digit($number)) return false;

		return true;
	}
}
