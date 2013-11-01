<?php
namespace Lattes\Routes;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class Teacher implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {
        $mapper = $this->db;
        return $mapper->teacher(array('id' => $id))->fetch();
    }
}
