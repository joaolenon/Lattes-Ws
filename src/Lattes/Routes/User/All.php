<?php
namespace Lattes\Routes\User;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Respect\Relational\Sql;

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
            $data = $mapper->user(array('lattes' => $lattes))->fetch();
            $data->experience = $this->getExperience($data->id);

            return $data;
        }
        
        return $mapper->user->fetchAll();
    }

    private function getExperience($id)
    {
        $years  = 0;
        $min    = 0;

        $mapper = $this->db;
        $professionalCollection = $mapper->professional->user[$id]->fetchAll(
            Sql::orderBy('end DESC, start DESC')
        );

        foreach ($professionalCollection as $key => $professional) {
            if ($professional->end == 9999) {
                $professional->end = date('Y');
            }

            if ($key == 0) {
                $min = $professional->start;
            }

            if ($key > 0) {
                if ($professional->start < $min) {
                    $min = $professional->start;
                }

                $last = $professionalCollection[$key-1];

                if ($professional->start > $min) {
                    continue;
                }

                if (($last->end == $professional->end)
                    && ($last->start == $professional->start)) {
                    continue;
                }

                if ($last->start < $professional->start)
                    continue;

                if ($last->start == $professional->start) {
                    if ($last->end > $professional->end) {
                        continue;
                    }
                }

                if ($last->end == $professional->end) {
                    if ($last->start > $professional->start) {
                        $years += $last->start - $professional->start; 
                    }
                    continue;
                }
            }

            if ($professional->start == $professional->end) {
                $years++;
                continue;
            }

            $years += $professional->end - $professional->start;
        }

        return $years;
    }
}
