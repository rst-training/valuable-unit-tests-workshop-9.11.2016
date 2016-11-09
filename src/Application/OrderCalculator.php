<?php
/**
 * Created by PhpStorm.
 * User: mbadzinski
 * Date: 09.11.16
 * Time: 11:37
 */

namespace RstGroup\ConferenceSystem\Application;


use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class OrderCalculator
{
    /**
     * @var DiscountService
     */
    protected $discountService;

    /**
     * OrderCalculator constructor.
     * @param DiscountService $discountService
     */
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * @param SeatsCollection $seats
     * @param $seatsPrices
     * @return float
     */
    public function calculateTotalCost(SeatsCollection $seats, $seatsPrices)
    {
        $totalCost = 0;
        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->getDiscountService()->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }

    /**
     * @return DiscountService
     */
    public function getDiscountService()
    {
        return $this->discountService;
    }
}