<?php
namespace Lattes\Routes\User;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class Professional implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {   
        $mapper = $this->db;
        
        return $mapper->professional->user[$id]->fetchAll();
    }
}
