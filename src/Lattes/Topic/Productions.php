<?php
namespace Lattes\Topic;

class Productions extends AbstractTopic
{
    protected $name  = 'productions';
    protected $keys  = array('title', 'year', 'type');
    protected $topic = 'ProducoesCientificas';
    protected $type  = null ;

    protected function filter($node)
    {
        if ('Demais tipos de produção técnica' == $node->nodeValue)
            $this->processingStop();
        
        $this->type = $this->typeOfPublication($node->nodeValue) ?: $this->type;

        if ('layout-cell-pad-5' == $node->getAttribute('class')) {
            preg_match('/[0-9]{4}/', $node->nodeValue, $years);
            $title = preg_replace(array('/.*( \. )/', '/\.\s[0-9]{4}.*/'), array('', ''), $node->nodeValue);

            $this->data[] = array(trim($title), end($years), $this->type);
        }
    }

    private function typeOfPublication($title)
    {
        $title = trim($title);

        switch ($title) {
            case 'Trabalhos completos publicados em anais de congressos':
            case 'Resumos expandidos publicados em anais de congressos':
            case 'Resumos publicados em anais de congressos':
            case 'Apresentações de Trabalho':
                return 'Congresso';
            case 'Capítulos de livros publicados':
                return 'Capítulos de livros';
            case 'Textos em jornais de notícias/revistas':
            case 'Artigos completos publicados em periódicos':
                return 'Periódicos';
        }
    }
}
