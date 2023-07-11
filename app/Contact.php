<?php

namespace App;


class Contact
{
	private $name;
	private $phone;

	public function __construct(string $name, string $phone)
	{
		$this->name = $name;
		$this->phone = $phone;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}
}
