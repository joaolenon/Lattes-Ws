<?php
namespace Lattes\Routes\User;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;

class All implements Routable
{
    protected $db;

    public function __construct(Mapper $db)
    {
        $this->db = $db;
    }

    public function get()
    {   
        $mapper = $this->db;
        $lattes  = filter_input(\INPUT_GET, 'lattes', \FILTER_SANITIZE_STRING);

        if ($lattes) {
            return $mapper->user(array('lattes' => $lattes))->fetch();
        }
        
        return $mapper->user->fetchAll();
    }
}
