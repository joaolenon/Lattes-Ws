<?php
namespace Lattes\Topic;

class Professional extends AbstractTopic
{
    protected $name  = 'professional';
    protected $keys  = array('workplace','start', 'end', 'link');
    protected $topic = 'AtuacaoProfissional';
    protected $loop  = 0;
    protected $index = 0;

    protected function filter($node)
    {
        $loop  =& $this->loop;
        $index =& $this->index;

        if ($node->getAttribute('class') == 'inst_back') {
            $this->data[++$loop][0] = trim($node->nodeValue);
        }

        if (strstr($node->getAttribute('class'), 'layout-cell-pad-5')) {
            if (trim($node->nodeValue) == 'Vínculo institucional') {
                $index = 0;
            }

            if ($index == 2) {
                list($start, $end) = array_pad(explode('-', $node->nodeValue), 2, null); 
                $this->data[$loop][$index++] = trim($start);
                $this->data[$loop][$index] = trim($end);        
            }

            if ($index == 4) {
                $this->data[$loop][$index] = trim($node->nodeValue);
            }

            $index++;
        }  
    }
}
