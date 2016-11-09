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
    public should_throw_on_nonexistent_reservation()
    {
    }
    public should_throw_on_double_call_with_existing_reservation()
    {
    }
    public should_throw_on_wrong_format_of_order_id()
    {
    }
    public should_cancel_reservation()
    {
    }
    public should_remove_reservation_from_wait_list()
    {
    }
    public should_increment_seats_quantity_with_empty_wait_list()
    {
    }
    public should_decrement_seats_quantity_after_getting_reservation_from_waiting_list()
    {
    }
    public should_move_reservation_from_empty_list()
    {
    }
}
