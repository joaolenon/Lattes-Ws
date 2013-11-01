<?php
namespace Lattes\Routes\Teacher;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class Production implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {   
        $mapper = $this->db;
        $year   = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);

        if ($year) {
            return $mapper->production(array('year' => $year))->teacher[$id]->fetchAll();
        }

        return $mapper->production->teacher[$id]->fetchAll();
    }
}
