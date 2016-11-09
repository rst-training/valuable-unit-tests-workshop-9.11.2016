<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use RstGroup\ConferenceSystem\Application\Registration;

class ReservationPaymentTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function should_calculate_total_cost_of_one_seat_reservation()
    {
        // given
        // reservation with seats
        $discountServiceMock = $this->getMock(DiscountService::class);
        $conferenceDaoMock = $this->getMock(ConferenceDao::class);
        $reservationPayment = new ReservationPayment($discountServiceMock, $conferenceDaoMock);
        
        // when
        // total cost is calculated        
        $totalCost = $reservationPayment->getTotalCost();
        
        // then
        // total cost equals x
        $this->assertSame($expectedCost, $totalCost);
    }
}
