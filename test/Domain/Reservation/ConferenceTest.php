<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationAlreadyExist;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationDoesNotExist;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsAvailabilityCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;

class ConferenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */


    public function check_cancel_reservation_for_reservation_order_in_conference(){
        $this->markTestSkipped();
    }

    public function check_reservations_quantity_after_cancel_reservation_order_in_conference(){
        $this->markTestSkipped();
    }

    public function check_seats_availability_after_cancel_reservation_order_in_conference(){
        $this->markTestSkipped();
    }

    public function check_whitelist_after_cancel_reservation_order_in_conference(){
        $this->markTestSkipped();
    }
}
