<?php
/**
 * Created by PhpStorm.
 * User: mjob
 * Date: 09.11.16
 * Time: 11:35
 */

namespace RstGroup\ConferenceSystem\Domain\Payment;


use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;

class PricingService
{
    private $discountService;
    private $conferenceDao;

    /**
     * PricingService constructor.
     * @param $discountService
     * @param $conferenceDao
     */
    public function __construct($discountService, $conferenceDao)
    {
        $this->discountService = $discountService;
        $this->conferenceDao = $conferenceDao;
    }

    /**
     * @param $reservation
     */
    public function getPrice(Reservation $reservation)
    {
        $reservationId = $reservation->getReservationId();

        $totalCost = 0;
        $seats = $reservation->getSeats();
        $seatsPrices = $this->conferenceDao->getSeatsPrices($reservationId->getConferenceId());

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }

        return $totalCost;
    }

}