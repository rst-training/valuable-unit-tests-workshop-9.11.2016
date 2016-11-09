<?php

namespace RstGroup\ConferenceSystem\Application;

class CalculationService
{
    public static function calculateSeatsPrice ($seats, $seatsPrices, $discountService) {
        $totalCost = 0;
        foreach ($seats->getAll() as $seat) {

            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }
}