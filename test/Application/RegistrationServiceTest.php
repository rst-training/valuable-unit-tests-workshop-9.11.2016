<?php
namespace RstGroup\ConferenceSystem\Domain\Payment\Test;
use RstGroup\ConferenceSystem\Application\RegistrationService;

/**
 * Created by PhpStorm.
 * User: rst_user
 * Date: 09.11.2016
 * Time: 11:05
 */
class RegistrationServiceTest extends \PHPUnit_Framework_TestCase
{

    protected $testedObject;

    public function setUp() {
        $testedObject = $this -> getMock(RegistrationService::class, array('getConferenceDao', 'getDiscountService', 'getPaypalPayments'));
    }

    public function shouldCalculateTotalCostWithDiscountWhenOrderConfirmed() {
        // given

        // when
        $this->testedObject->confirmOrder();
    }
}