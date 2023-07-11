<?php

namespace App;

use App\Interfaces\CarrierInterface;
use App\Services\ContactService;


class Mobile
{

	protected $carrier;

	function __construct(CarrierInterface $carrier)
	{
		$this->carrier = $carrier;
	}


	public function makeCallByName($name = '')
	{
		if (empty($name)) return null;

		try {
			$contact = ContactService::findByName($name);
			$this->carrier->dialContact($contact);
			return $this->carrier->makeCall();
		} catch (\Exception $e) {
			return $e;
		}
	}

	public function sendSms(string $number = '', string $body): bool
	{
		if (empty($number) || empty($body)) return null;

		if (!ContactService::validateNumber($number)) {
			throw new \Exception('Invalid phone number');
		}

		return $this->carrier->sendSms($number, $body);
	}
}
