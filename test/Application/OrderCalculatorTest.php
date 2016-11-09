<?php
/**
 * Created by PhpStorm.
 * User: mbadzinski
 * Date: 09.11.16
 * Time: 11:46
 */

namespace RstGroup\ConferenceSystem\Application;


use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class OrderCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_should_return_zero_with_empty_order()
    {
        /** @var OrderCalculator $orderCalculator */
        $orderCalculator = $this->getMockBuilder(OrderCalculator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seats = new SeatsCollection();
        $this->assertEquals(0, $orderCalculator->calculateTotalCost($seats, []));
    }

    public function test_should_return_price_with_one_seat_in_order()
    {
        $price = 10;

        $discountService = $this->getMockBuilder(DiscountService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $discountService
            ->method('calculateForSeat')
            ->willReturn(999);

        $orderCalculator = $this->getMockBuilder(OrderCalculator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $orderCalculator
            ->method('getDiscountService')
            ->willReturn($discountService);

        /** @var OrderCalculator $orderCalculator */
        $seats = new SeatsCollection();
        $seats->add(new Seat('catA', 1));

        $seatsPrice = [
            'catA' => [$price]
        ];

        $this->assertEquals($price, $orderCalculator->calculateTotalCost($seats, $seatsPrice));
    }
}
