<?php

namespace RstGroup\ConferenceSystem\Domain\Registration\Test;

use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
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

class RegistrationServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @todo: remove it
     */

    public function test_verify_calculation_of_total_cost_with_discount(){



       /* $registrationService = $this->getMock(RegistrationService::class)->method(['getPaypalPayments']);

        $payPalPayments = $this->getMock(PaypalPayments::class);
        $payPalPayments->method('getApprovalLink')->with($this->any(), 100);

        $registrationService->method('getPaypalPayments')->willReturn($payPalPayments);*/
    }
}
