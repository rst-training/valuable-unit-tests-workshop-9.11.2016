<?php


namespace RstGroup\ConferenceSystem\Domain\Payment\Test;


use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class ConfigurationStabEnableAtLeastTenEarlyBirdSeats extends SeatsStrategyConfiguration
{
    public function isEnabledForSeat($discountStrategy, $seat)
    {
        return $discountStrategy instanceof AtLeastTenEarlyBirdSeatsDiscountStrategy;
    }
}

class DiscountServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */

    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $configuration = new ConfigurationStabEnableAtLeastTenEarlyBirdSeats();
        $discountService = new DiscountService($configuration);
        $seat = new Seat('basic', 10);

        $this->assertEquals(59.5, $discountService->calculateForSeat($seat, 7), 0.01);
    }
}
