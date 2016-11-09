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

        $orderCalculator = new OrderCalculator($discountService);

        /** @var OrderCalculator $orderCalculator */
        $seats = new SeatsCollection();
        $seats->add(new Seat('catA', 1));

        $seatsPrice = [
            'catA' => [$price]
        ];

        $this->assertEquals($price, $orderCalculator->calculateTotalCost($seats, $seatsPrice));
    }

    public function test_should_return_price_with_two_the_same_type_seat_in_order()
    {
        $price = 10;

        $discountService = $this->getMockBuilder(DiscountService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $discountService
            ->method('calculateForSeat')
            ->willReturn(999);

        $orderCalculator = new OrderCalculator($discountService);

        /** @var OrderCalculator $orderCalculator */
        $seats = new SeatsCollection();
        $seats->add(new Seat('catA', 2));

        $seatsPrice = [
            'catA' => [$price]
        ];

        $this->assertEquals($price * 2, $orderCalculator->calculateTotalCost($seats, $seatsPrice));
    }

    public function test_should_return_price_with_two_other_type_seat_in_order()
    {
        $priceA = 10;
        $priceB = 50;

        $discountService = $this->getMockBuilder(DiscountService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $discountService
            ->method('calculateForSeat')
            ->willReturn(999);

        $orderCalculator = new OrderCalculator($discountService);

        /** @var OrderCalculator $orderCalculator */
        $seats = new SeatsCollection();
        $seats->add(new Seat('catA', 1));
        $seats->add(new Seat('catB', 1));

        $seatsPrice = [
            'catA' => [$priceA],
            'catB' => [$priceB],
        ];

        $this->assertEquals($priceA + $priceB, $orderCalculator->calculateTotalCost($seats, $seatsPrice));
    }

    public function test_should_return_price_with_one_discounter_seat_in_order()
    {
        $priceA = 10;
        $priceDiscountedA = 5;

        $discountService = $this->getMockBuilder(DiscountService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $discountService
            ->method('calculateForSeat')
            ->willReturn($priceDiscountedA);

        $orderCalculator = new OrderCalculator($discountService);

        /** @var OrderCalculator $orderCalculator */
        $seats = new SeatsCollection();
        $seats->add(new Seat('catA', 1));

        $seatsPrice = [
            'catA' => [$priceA],
        ];

        $this->assertEquals($priceDiscountedA, $orderCalculator->calculateTotalCost($seats, $seatsPrice));
    }
}
