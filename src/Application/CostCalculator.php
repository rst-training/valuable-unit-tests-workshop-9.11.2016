<?php
namespace RstGroup\ConferenceSystem\Application;

class CostCalculator
{
    public function __construct(array $seatsPrices, $discountService)
    {
        $this->seatsPrices = $seatsPrices;
        $this->discountService = $discountService;
    }

    public function CalculateCost($seats)
    {
        $totalCost = 0;

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService()->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }

        return $totalCost;
    }
}
