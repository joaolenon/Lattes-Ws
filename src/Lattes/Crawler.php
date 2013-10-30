<?php
namespace Lattes;

use Lattes\Topic\PersonalDetails;
use Lattes\Topic\EducationalBackground;
use Lattes\Topic\Productions;

class Crawler
{
    private $request;
    public $personalDetails;
    public $educational;
    public $productions;


    public function __construct($url)
    {
        $this->request                  = new Request($url);    
        $this->personalDetails          = new PersonalDetails;
        $this->educationalBackground    = new EducationalBackground;
        $this->productions              = new Productions;
    }

    public function execute()
    {
        $this->personalDetails->append($this->educationalBackground);
        $this->personalDetails->append($this->productions);
        $this->personalDetails->run($this->request);
    }
}
