<?php
namespace Lattes\Routes\Teacher;

use Respect\Rest\Routable;

class All implements Routable
{
    public function get($course)
    {
        $data = array('view' => 'teacher/all');

        $courses = array(
            'sistemas-informacao' => array(
                'rogerio-cardoso' => array(
                    'name' => 'Rogério Cardoso',
                    'publications' => array(
                        array('title' => 'Aplicação de Ferramentas da Produção Enxuta na Gestão de Projetos de EAD', 'date' => 2010),
                        array('title' => 'Planejamento: Capacitação de Docentes para Atuarem em Disciplinas Semi-Presenciais', 'date' => 2008)
                    )
                ),
            ),
        );

        if (!array_key_exists($course, $courses)) {
            throw new \InvalidArgumentException("Course not found.");
        }

        $data['teachers'] = $courses[$course];

        return $data;
    }
}
