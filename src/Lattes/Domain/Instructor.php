<?php

class Instructor
{
    protected $id;
    protected $name;
    protected $lattes;
    protected $groups = array();
    protected $degrees = array();
    protected $bibliographicProductions = array();
    protected $profissionalExperience = array();

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

    public function setLattes($lattes)
    {
        $lattes = trim($lattes);
        if ($lattes == '') {
            throw new \InvalidArgumentException("The lattes must be valid.");
        }

        $this->lattes = $lattes;
    }

    public function getLattes()
    {
        return $this->lattes;
    }

    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function isInGroup(Group $group)
    {
        return in_array($group, $this->groups);
    }

    public function addDegree(Degree $degree)
    {
        $this->degrees[] = $degree;
    }

    public function getDegrees()
    {
        return $this->degrees;
    }

    public function hasDegree(Degree $degree)
    {
        return in_array($degree, $this->degrees);
    }

    public function addBibliographicProduction(BibliographicProduction $production)
    {
        $this->bibliographicProductions[] = $production;
    }

    public function getBibliographicProdution()
    {
        return $this->bibliographicProductions;
    }

    public function addProfessionalExperience(ProfessionalExperience $experience)
    {
        $this->professionalExperience[] = $experience;
    }

    public function getProfessionalExperience()
    {
        return $this->professionalExperience;
    }
}