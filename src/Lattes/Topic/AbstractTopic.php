<?php
namespace Lattes\Topic;

use Lattes\Request;

abstract class AbstractTopic
{
    public $data = array();
    public $successor;
    protected $keys = array();
    protected $topic;
    protected $processingStop = false;

    public function append(AbstractTopic $successor)
    {
        if(is_null($this->successor)) {
            $this->successor = $successor;
            return;
        }

        $this->successor->append($successor);
    }

    protected function processingStop($stop = true)
    {
        $this->processingStop = $stop;
    }

    public function processing($nodes = null)
    {
        $nodes = $nodes ?: $this->nodes();

        foreach ($nodes as $node) {
            if ($node->nodeName == '#text')
                continue;

            $this->filter($node);

            if (!$this->processingStop)
                $this->processing($node->childNodes);
        }
    }


    public function run(Request $request)
    {
        $nodes = $request->nodes($this->topic);
        $this->processing($nodes);
        $this->combine();

        if(is_object($this->successor))
            $this->successor->run($request);
    }

    protected function combine()
    {
        foreach ($this->data as $key => $value) {
            if (!is_array($value)) {
                $this->data = array_combine($this->keys, $this->data);
                break;
            }

            $this->data[$key] = array_combine($this->keys,$value);
        }
    }

    abstract protected function filter($node);
}
