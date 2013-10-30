<?php
namespace Lattes\Topic;

class EducationalBackground extends AbstractTopic
{
    protected $name  = 'educational';
    protected $keys  = array('start', 'end', 'title', 'type');
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
            
            preg_match("/Especialização|Graduação|Mestrado|Doutorado|Pós-Doutorado/", $node->nodeValue, $type);

            $this->data[$this->loop][$this->index] = current($type);

            if (!$type)
                unset($this->data[$this->loop]);

            $this->loop  = ($this->index == 3) ? ++$this->loop : $this->loop;
            $this->index = ($this->index == 3) ? 0 : ++$this->index;
        }
    }
}
