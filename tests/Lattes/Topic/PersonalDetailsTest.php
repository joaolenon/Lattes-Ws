<?php
namespace Lattes\Topic;

class PersonalDetailsTest extends \PHPUnit_Framework_TestCase
{
    protected $personalDetails;

    public function setUp()
    {
        $this->personalDetails = new PersonalDetails(TESTS_PATH . DS . 'lattes.html');
    }

    public function testFilter()
    {
        $this->personalDetails->run();
        $this->personalDetails->combine();

        $data = $this->personalDetails->getData();

        $this->assertEquals('Rogério Cardoso', $data['personalDetails']['name']);
        $this->assertEquals('CARDOSO, Rogério;CARDOSO, R.', $data['personalDetails']['citation']);
    }
}
