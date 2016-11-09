<?php
namespace RstGroup\ConferenceSystem\Application\calculationCostTest;
use RstGroup\ConferenceSystem\Application\RegistrationService;

class calculationCostTest extends \PHPUnit_Framework_TestCase
{
    public function calculation_cost_without_discount()
    {
        $expectedCost = 150;
        $reservation = $this->getMock('RegistrationService');
        
        $calculationCost = new RegistrationService();
        assertEquals($expectedCost,$calculationCost->getCost($reservation));
    }
}