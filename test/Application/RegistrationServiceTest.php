<?php

namespace RstGroup\ConferenceSystem\Application;

use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;

class RegistrationServiceTest extends \PHPUnit_Framework_TestCase
{
    public function test_total_cost_zero()
    {
        $this->markTestSkipped();
        $conferenceId = 10;
        $conferenceIdObj = new ConferenceId($conferenceId);
        $orderId = 10;
        $orderIdObj = new OrderId($conferenceId);

        // line 36
        $conference = $this->getMockBuilder(Conference::class)
            ->disableOriginalConstructor()
            ->getMock();
        $conferenceMemoryRepository = $this->getMockBuilder(ConferenceMemoryRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $conferenceMemoryRepository
            ->method('get')
            ->willReturn($conference);

        // line 37
        $reservation = $this->getMockBuilder(Reservation::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reservationCollection = $this->getMockBuilder(ReservationsCollection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reservationCollection
            ->method('get')
            ->willReturn($reservation);
        $conference
            ->method('getReservations')
            ->willReturn($reservationCollection);

        // line 40
        $reservation
            ->method('getSeats')
            ->willReturn(array());


        // line 54
        $reservationService = $this->getMockBuilder(RegistrationService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paypalPayments = $this->getMockBuilder(PaypalPayments::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paypalPayments
            ->expects($this->once())
            ->method('getApprovalLink')
            ->with([$conference, 0])
            ->willReturn('');
        $reservationService
            ->method("getPaypalPayments")
            ->willReturn($paypalPayments);

        $reservationService->confirmOrder($orderId, $conferenceId);
    }
}
