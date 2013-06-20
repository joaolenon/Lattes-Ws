<?php
namespace Lattes\Routes\Course;

use Respect\Rest\Routable;

class All implements Routable
{
    public function get()
    {
        $data = array('view' => 'course/all');

        $data['courses'] = array(
            array('slug' => 'sistemas-informacao', 'name' => 'Sistemas de Informação'),
        );

        return $data;
    }
}
