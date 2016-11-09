<?php
/**
 * Created by PhpStorm.
 * User: rst_user
 * Date: 09.11.2016
 * Time: 11:37
 */

namespace RstGroup\ConferenceSystem\Domain\Reservation;


class ReservationCostCalculator
{

    protected $conferenceRepository;

    protected $conferenceSeatsDao;

    protected $discountService;

    /**
     * ReservationCostCalculator constructor.
     * @param $conferenceRepository
     * @param $conferenceSeatsDao
     * @param $discountService
     */
    public function __construct($conferenceRepository, $conferenceSeatsDao, $discountService)
    {
        $this->conferenceRepository = $conferenceRepository;
        $this->conferenceSeatsDao = $conferenceSeatsDao;
        $this->discountService = $discountService;
    }


    public function calculate($orderId, $conferenceId) {
        $conference = $this->conferenceRepository->get(new ConferenceId($conferenceId));
        $reservation = $conference->getReservations()->get(new ReservationId(new ConferenceId($conferenceId), new OrderId($orderId)));

        $totalCost = 0;
        $seats = $reservation->getSeats();
        $seatsPrices = $this->conferenceSeatsDao->getSeatsPrices($conferenceId);

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }
}