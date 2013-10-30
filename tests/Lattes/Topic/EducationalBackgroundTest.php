<?php
namespace Lattes\Topic;

class EducationalBackgroundTest extends \PHPUnit_Framework_TestCase
{
    protected $educational;

    public function setUp()
    {
        $this->educational = new EducationalBackground(TESTS_PATH . DS . 'lattes.html');
    }

    public function testFilter()
    {
        $this->educational->run();
        $this->educational->combine();

        $data = $this->educational->getData();

        $this->assertEquals('2012', $data['educational'][0]['opening']);
        $this->assertEquals('Doutorado em andamento em Ciência da Computação. Universidade Federal de São Carlos, UFSCAR, Brasil.', $data['educational'][0]['title']);
        $this->assertEquals('Doutorado', $data['educational'][0]['type']);

        $this->assertEquals('1983', $data['educational'][8]['opening']);
        $this->assertEquals('1987', $data['educational'][8]['conclusion']);
        $this->assertEquals('Graduação em Engenharia Elétrica - ênfase Telecomunicações. Instituto Nacional de Telecomunicações.', $data['educational'][8]['title']);
        $this->assertEquals('Graduação', $data['educational'][8]['type']);
    }
}
