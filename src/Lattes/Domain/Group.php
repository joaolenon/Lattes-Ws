<?php

namespace Lattes\Domain;

class Group
{
	protected $id;
	protected $name;

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

	public function setName($name)
	{
		$name = trim($name);
		if ($name == '') {
			throw new \InvalidArgumentException("The name cannot be null.");
		}

		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}
}