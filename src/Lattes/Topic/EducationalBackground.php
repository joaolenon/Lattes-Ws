<?php
namespace Lattes\Topic;

class EducationalBackground extends AbstractTopic
{
    protected $name  = 'educational';
    protected $keys  = array('start', 'end', 'title', 'type', 'weight');
    protected $topic = 'FormacaoAcademicaTitulacao';
    protected $index = 0;
    protected $loop  = 0;

    protected function filter($node)
    {
        if (strstr($node->getAttribute('class'), 'layout-cell-pad-5')) {

            if ($this->index == 0) {
                list($start, $conclusion) = array_pad(explode('-', $node->nodeValue), 2, null);

                $this->data[$this->loop][$this->index++]   = trim($start); 
                $this->data[$this->loop][$this->index++]   = trim($conclusion);
                return;
            }

            $this->data[$this->loop][$this->index++] = trim(preg_replace("/(Título:).*/", "", $node->nodeValue));
            
            preg_match("/Graduação|Especialização|Mestrado|Doutorado|Pós-Doutorado/", $node->nodeValue, $type);
            $type = current($type);

            $this->data[$this->loop][$this->index++]    = $type;
            $this->data[$this->loop][$this->index]      = $this->getWeigthOfType($type);

            if (!$type)
                unset($this->data[$this->loop]);

            $this->loop  = ($this->index == 4) ? ++$this->loop : $this->loop;
            $this->index = ($this->index == 4) ? 0 : ++$this->index;
        }
    }

    private function getWeigthOfType($type)
    {
        switch ($type) {
            case 'Graduação':
                return 1;
            case 'Especialização':
                return 2;
            case 'Mestrado':
                return 3;
            case 'Doutorado':
                return 4;
            case 'Pós-Doutorado':
                return 5;
        }
    }
}
