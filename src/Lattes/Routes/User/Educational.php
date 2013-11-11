<?php
namespace Lattes\Routes\User;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class Educational implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {   
        $mapper = $this->db;
        
        return $mapper->titulation->user[$id]->fetchAll();
    }
}
