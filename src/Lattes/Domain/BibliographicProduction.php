<?php

namespace Lattes\Domain;

abstract class BibliographicProduction
{
    protected $id;
    protected $name;
    protected $year;
    protected $classification;
    protected $instructor;

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
            throw new \InvalidArgumentException("The name must be valid.");
        }

        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setYear($year)
    {
        $year = (int) $year;
        if ($year <= 0) {
            throw new \InvalidArgumentException("The year must be valid.");
        }

        $this->year = $year;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setClassification($classification)
    {
        if (!preg_match('/[A-Z]{1}[0-9]{1}/', $classification) &&
             strlen($classification) == 2
        ) {
            throw new \InvalidArgumentException("The classification must be a valid qualis classification.");
        }

        $this->classification = $classification;
    }

    public function setInstructor(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }

    public function getInstructor()
    {
        return $this->instructor;
    }
}