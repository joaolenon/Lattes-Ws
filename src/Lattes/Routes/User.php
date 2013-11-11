<?php
namespace Lattes\Routes;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class User implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {
        $mapper = $this->db;
        return $mapper->user[$id]->fetch();
    }
}
