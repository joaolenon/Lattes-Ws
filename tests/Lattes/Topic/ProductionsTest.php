<?php
namespace Lattes\Topic;

class ProductionsTest extends \PHPUnit_Framework_TestCase
{
    protected $productions;

    public function setUp()
    {
        $this->productions = new productions(TESTS_PATH . DS . 'lattes.html');
    }

    public function testFilter()
    {
        $this->productions->run();

        $data = $this->productions->getData();
        $this->productions->combine();

        $data = $this->productions->getData();

        $this->assertEquals('Aplicação de Ferramentas da Produção Enxuta na Gestão de Projetos de EAD. In: 16º Congresso Internacional de Educação a Distância, 2010, Foz do Iguaçu. ANAIS 16º CIEAD - 2010, 2010.', $data['productions'][0]['title']);
        $this->assertEquals('2010', $data['productions'][0]['year']);
    }
}
