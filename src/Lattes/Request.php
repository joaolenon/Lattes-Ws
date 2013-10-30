<?php
namespace Lattes;

class Request
{
    private $dom;

    public function __construct($url = null)
    {
        if (!is_null($url))
            $this->loadFile($url);
    }

    public function loadFile($url)
    {
        $file = file_get_contents($url);

        libxml_use_internal_errors(true);
        $this->dom = new \DomDocument();
        $this->dom->loadHTML($file);

        $scripts = $this->dom->getElementsByTagName("script");
        while ($scripts->length) {
            $scripts->item(0)->parentNode->removeChild($scripts->item(0));
        }
    }

    public function nodes($topic)
    {
        $DOMXPath  = new \DOMXPath($this->dom);
        $xpath      = sprintf("//a[contains(@name,'%s')]", $topic);
        $nodeList   = $DOMXPath->query($xpath);
        $parentNode = $nodeList->item(0)->parentNode;
        $childNodes = $parentNode->childNodes;

        return $childNodes;
    }
}
