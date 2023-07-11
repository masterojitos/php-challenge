<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;

use App\Call;
use App\Contact;
use App\Mobile;
use App\Services\CarrierChichoService;

class MobileTest extends TestCase
{
	private $contact;
	private $data;

	protected function setUp(): void
	{
		$this->data = ['name' => 'Ricardo', 'phone' => '991515152'];
		$this->contact = new Contact($this->data['name'], $this->data['phone']);
		$contactService = m::mock('alias:\App\Services\ContactService');
		$contactService->shouldReceive('findByName')->once()->andReturn($this->contact)->byDefault();
		$contactService->shouldReceive('validateNumber')->once()->andReturn(true);
	}

	/** @test */
	public function it_makeCallByName_returns_null_when_contact_name_is_empty()
	{
		$carrierService = new CarrierChichoService();
		$mobile = new Mobile($carrierService);

		$this->assertNull($mobile->makeCallByName(''));
	}

	/** @test */
	public function it_makeCallByName_make_a_call_when_contact_name_is_valid()
	{
		$carrierService = new CarrierChichoService();
		$mobile = new Mobile($carrierService);
		$this->assertInstanceOf(Call::class, $mobile->makeCallByName($this->contact->getName()));
	}

	/** @test */
	public function it_send_sms_when_number_is_valid()
	{
		$carrierService = m::mock('\App\Services\CarrierChichoService', ['sendSms' => true]);
		$mobile = new Mobile($carrierService);
		$this->assertTrue($mobile->sendSms($this->data['name'], 'sample message'));
	}

	/** @test */
	public function it_send_twilio_when_number_is_valid()
	{
		$carrierService = m::mock('\App\Services\CarrierTwilioService', ['sendSms' => true]);
		$mobile = new Mobile($carrierService);
		$this->assertTrue($mobile->sendSms($this->data['name'], 'sample message'));
	}
}
