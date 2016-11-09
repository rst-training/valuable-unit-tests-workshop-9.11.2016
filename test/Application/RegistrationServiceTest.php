<?php

namespace RstGroup\ConferenceSystem;

use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;

class RegistrationServiceTest extends \PHPUnit_Framework_TestCase
{

    /*
     * @var RegistrationService
     */
    private $service;

    /*
     *@var PaypalPayments
     */
    private $paypalPayments;

    public function setUp()
    {
        $this->service = $this->getMock("RegistrationService", ["getPaypalPayments", "getDiscountService", "getConferenceDao"]);
    }

    public function test_confirmOrder_seatsWithDiscount_discountAppliedOnTotalCost()
    {
//        $service = getMock

    }

}
