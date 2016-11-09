<?php

namespace RstGroup\ConferenceSystem\Aplication\Test;

use RstGroup\ConferenceSystem\Application\CalculationService;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;


class RegistrationServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function should_verify_calculation_of_total_cost_with_discount(){
        $seats = SeatsCollection::fromArray(array(new Seat('basic', 20),new Seat('vip',20)));
        CalculationService::calculateSeatsPrice($seats, array(
            'basic' => 30,
            'vip' => 90
        ),);
    }
}
