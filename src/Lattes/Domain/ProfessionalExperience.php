<?php

namespace Lattes\Domain;

class ProfessionalExperience
{
	protected $id;
	protected $instructor;
	protected $college;
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

	public function setInstructor(Instructor $instructor)
	{
		$this->instructor = $instructor;
	}

	public function getInstructor()
	{
		return $this->instructor;
	}

	public function setCollege($college)
	{
		$college = trim($college);
		if ($college == '') {
			throw new \InvalidArgumentException("The college cannot be null.");
		}

		$this->college = $college;
	}

	public function getCollege()
	{
		return $this->college;
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

	public function __toString()
	{
		return $this->instructor->getName().
			   ' with worked on '.$this->college.
			   ' from '.$this->begin->format('Y-m-d').
			   ' until '.$this->end->format('Y-m-d');
	}
}