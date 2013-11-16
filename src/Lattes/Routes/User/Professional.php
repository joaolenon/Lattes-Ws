<?php
namespace Lattes\Routes\User;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Respect\Relational\Sql;

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
        $professionalCollection = $mapper->professional->user[$id]->fetchAll(
            Sql::orderBy('end DESC, start DESC')
        );

        return $professionalCollection;
    }
}
