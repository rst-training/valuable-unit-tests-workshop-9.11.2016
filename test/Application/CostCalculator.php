<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;


use RstGroup\ConferenceSystem\Application\CostCalculator;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountCalculator;

class CostCalculatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function return_calculated_cost_of_conference_without_discounts()
    {
        //given
        $seatsPrices = [1, 2];
        $discountService = $this->getMock(DiscountCalculator::class)->disableOriginalConstructor();
        $seats = [new Seat(1, 10), new Seat(2, 10)];
        $discountService->expects($this->at(0))->method('calculateForSeat')->with($seat[0], $seatsPrices[0]);
        $discountService->expects($this->at(1))->method('calculateForSeat')->with($seat[1], $seatsPrices[1]);
        $costCalculator = new CostCalculator($seatsPrices, $discountService);

        //when
        $result = $costCalculator->calculateCost($seats);

        //then
        $this->assertEquals(10*1 + 10 *2, $result);
    }
}
