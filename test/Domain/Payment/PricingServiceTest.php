<?php
/**
 * Created by PhpStorm.
 * User: mjob
 * Date: 09.11.16
 * Time: 11:36
 */

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;


use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\PricingService;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class PricingServiceTest extends \PHPUnit_Framework_TestCase
{
    private $discountService;
    private $conferenceDao;
    private $pricingService;

    public function setUp()
    {
        $this->discountService = $this->getMock(DiscountService::class);
        $this->conferenceDao = $this->getMock(ConferenceSeatsDao::class);
        $this->pricingService = new PricingService($this->discountService, $this->conferenceDao);
    }

    public function test_getPrice_withDiscount_calculatesTotalPriceWithDiscount()
    {

    }
}
