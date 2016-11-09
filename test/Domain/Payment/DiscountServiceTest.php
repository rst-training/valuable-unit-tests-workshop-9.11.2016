<?php


namespace RstGroup\ConferenceSystem\Domain\Payment\Test;


use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountServiceTest extends \PHPUnit_Framework_TestCase
{
//    /**
//     * @test
//     */
//    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
//    {
//        $configuration = $this->getMock(SeatsStrategyConfiguration::class);
//        $discountService = new DiscountService($configuration);
//        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();
//
//        $configuration->expects($this->at(0))->method('isEnabledForSeat')->with(AtLeastTenEarlyBirdSeatsDiscountStrategy::class)->willReturn(true);
//        $configuration->expects($this->at(1))->method('isEnabledForSeat')->with(FreeSeatDiscountStrategy::class)->willReturn(false);
//        $seat->expects($this->exactly(2))->method('getQuantity')->willReturn(10);
//
//        $this->assertEquals(59.5, $discountService->calculateForSeat($seat, 7), 0.01);
//    }

    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $price = 7;
        $seats = 10;
        $discountValue = 0.85;

        $configuration = $this->getMock(SeatsStrategyConfiguration::class);
        $discountService = new DiscountService($configuration);
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();

        $configuration->expects($this->any())
            ->method('isEnabledForSeat')
            ->will($this->returnCallback([$this, 'getSeatStrategyEnabled']));

        $seat->method('getQuantity')->willReturn($seats);

        $this->assertEquals($price * $seats * $discountValue,
            $discountService->calculateForSeat($seat, $price),
            "message",
            0.01);
    }

    /**
     * @param $type
     * @return bool
     */
    public function getSeatStrategyEnabled($type)
    {
        switch ($type) {
            case AtLeastTenEarlyBirdSeatsDiscountStrategy::class:
                return true;
            case FreeSeatDiscountStrategy::class:
            default:
                return false;
        }
    }
}
