<?php
namespace Lattes\Topic;

class Professional extends AbstractTopic
{
    protected $name  = 'professional';
    protected $keys  = array('workplace','start', 'end', 'link');
    protected $topic = 'AtuacaoProfissional';
    public $experience = 0;
    protected $loop  = 0;
    protected $index = 0;

    protected function filter($node)
    {
        $loop  =& $this->loop;
        $index =& $this->index;

        if ($node->getAttribute('class') == 'inst_back') {
            $this->data[$loop][0] = trim($node->nodeValue);
        }

        if (strstr($node->getAttribute('class'), 'layout-cell-pad-5')) {
            if (trim($node->nodeValue) == 'Vínculo institucional') {
                $index = 0;
            }

            if ($index == 2) {
                list($start, $end) = array_pad(explode('-', trim($node->nodeValue)), 2, null); 
                $this->data[$loop][$index++] = (int) $start;
                $this->data[$loop][$index] = (int) $end; 
            }

            if ($index == 4) {
                if (!isset($this->data[$loop][0])) {
                    $this->data[$loop][0] = $this->data[$loop-1][0];
                }
                ksort($this->data[$loop]);
                
                $this->data[$loop++][$index] = trim($node->nodeValue);
            }

            $index++;
        }  
    }
}
