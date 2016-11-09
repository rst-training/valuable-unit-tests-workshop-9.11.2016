<?php


namespace RstGroup\ConferenceSystem\Domain\Payment\Test;


use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $number_of_available_seats = 10;
        $price = 7;
        $discount = (1-0.15);
        
        $configuration = $this->getMock(SeatsStrategyConfiguration::class);
        $discountService = new DiscountService($configuration);
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();

        $map = [
            ["AtLeastTenEarlyBirdSeatsDiscountStrategy",true],
            ["FreeSeatDiscountStrategy",false]
        ];
        $configuration->method('isEnabledForSeat')->willReturn($this->returnValue($map));

        $seat->method('getQuantity')->willReturn($number_of_available_seats);

        $this->assertEquals($number_of_available_seats*$price*$discount, $discountService->calculateForSeat($seat, $price), 0.01);
    }
}
