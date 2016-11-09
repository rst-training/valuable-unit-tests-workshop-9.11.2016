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
     * @todo: remove it
     */
    public function shouldHandleOrderIdEquals0()
    {}
    public function shouldThrowIfReservatioinExists()
    {}
    public function shouldDoNothingInCaseOfEmptySeatsCollection()
    {}
    public function shouldNotReserveIfNotEnoughtSeatsAvailable()
    {}
    public function shouldAddReservationToWhiteListInCesaOfNotEnoughtSits()
    {}
    public function shouldReservIfExactNumberOfSeatsAvailable()
    {}
    public function shouldReserveOnlySpecificTypeOfSeats()
    {}
    public function shouldSubtractReservedSeatsFromAvailable()
    {}
    public function shouldDecrementOnlySpecificTypeOfSeatsInCaseOfReservation()
    {}
    public function shouldThrowInCaseOfWrongSeatsType()
    {}
    public function shouldThrowInCaseOfWrongOrderIdType()
    {}


}
