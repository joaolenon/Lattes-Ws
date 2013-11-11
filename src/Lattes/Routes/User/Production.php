<?php
namespace Lattes\Routes\User;

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
        $filter = array('user_id' => $id);
        $start  = filter_input(INPUT_GET, 'start', FILTER_VALIDATE_INT);
        $end    = filter_input(INPUT_GET, 'end', FILTER_VALIDATE_INT);

        if ($start && $end) {
            $filter['year >='] = $start;
            $filter[] = array('year <=' => $end);
        }

        return $mapper->production($filter)->fetchAll();
    }
}
