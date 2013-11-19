<?php
namespace Lattes\Routines;

class Xml
{
    private $dom;
    private $root;

    public function __invoke($data)
    {
        $xml = new \SimpleXMLElement('<root/>');
        $convert = $this->convert($data, $xml);

        echo $convert->asXML();
    }

    private function convert($data, $xml)
    {
        foreach ($data as $k => $v) {
            $k = is_numeric($k) ? 'row' :  $k;

            is_object($v)
                    ? $this->convert($v, $xml->addChild($k))
                    : $xml->addChild($k, htmlspecialchars($v));
        }

        return $xml;
    }
}
