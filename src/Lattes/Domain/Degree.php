<?php

namespace Lattes\Domain;

abstract class Degree
{
	protected $id;
	protected $curse;
	protected $begin;
	protected $end;

	public function setId($id)
	{
		$id = (int) $id;
		if ($id <= 0) {
			throw new \InvalidArgumentException("The id must be integer.");
		}

		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setCurse($curse)
	{
		$curse = trim($curse);
		if ($curse == '') {
			throw new \InvalidArgumentException("The curse cannot be null.");
		}

		$this->curse = $curse;
	}

	public function getCurse()
	{
		return $this->curse;
	}

	public function setBegin($begin)
	{
		$datetime = new \DateTime($begin);
		if (!$datetime) {
			throw new \InvalidArgumentException("The begin must be a valid date.");
		}

		$this->begin = $datetime;
	}

	public function getBegin()
	{
		return $this->begin;
	}

	public function setEnd($end)
	{
		$datetime = new \DateTime($end);
		if (!$datetime) {
			throw new \InvalidArgumentException("The end must be a valid date.");
		}

		$this->end = $datetime;
	}

	public function getEnd()
	{
		return $this->end;
	}
}