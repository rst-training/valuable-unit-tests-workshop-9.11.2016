<?php
/**
 * Created by PhpStorm.
 * User: kkowalska
 * Date: 09.11.16
 * Time: 11:37
 */

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;


use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\TotalCostService;

class TotalCostServiceTest extends \PHPUnit_Framework_TestCase
{
    public function test_verify_calculation_of_total_cost_with_discount(){
        $expectedCost = 100;
        $reservation = $this->getMock(Reservation::class);
        $totalCostService = new TotalCostService();
        assertEquals($expectedCost, $totalCostService->getTotalCost($reservation));
    }
}