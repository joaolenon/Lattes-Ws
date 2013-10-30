<?php
namespace Lattes\Topic;

class PersonalDetails extends AbstractTopic
{
    protected $keys  = array('name', 'citation');
    protected $topic = 'Identificacao';

    protected function filter($node)
    {
        if ('layout-cell-pad-5' == $node->getAttribute('class'))
            $this->data[] = $node->nodeValue;
    }
}
