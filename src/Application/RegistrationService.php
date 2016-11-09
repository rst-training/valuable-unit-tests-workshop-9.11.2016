<?php

namespace RstGroup\ConferenceSystem\Application;

use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationService
{
    /**
     * @var OrderCalculator
     */
    protected $orderCalculator;

    /**
     * @var PaypalPayments
     */
    protected $paypalPayments;

    /**
     * @var DiscountService
     */
    protected $discountService;

    /**
     * @var ConferenceSeatsDao
     */
    protected $conferenceDao;

    /**
     * @var ConferenceMemoryRepository
     */
    protected $conferenceRepository;

    /**
     * RegistrationService constructor.
     * @param OrderCalculator $orderCalculator
     * @param PaypalPayments $paypalPayments
     * @param DiscountService $discountService
     * @param ConferenceSeatsDao $conferenceDao
     * @param ConferenceMemoryRepository $conferenceRepository
     */
    public function __construct(OrderCalculator $orderCalculator, PaypalPayments $paypalPayments, DiscountService $discountService, ConferenceSeatsDao $conferenceDao, ConferenceMemoryRepository $conferenceRepository)
    {
        $this->orderCalculator = $orderCalculator;
        $this->paypalPayments = $paypalPayments;
        $this->discountService = $discountService;
        $this->conferenceDao = $conferenceDao;
        $this->conferenceRepository = $conferenceRepository;
    }


    public function reserveSeats($orderId, $conferenceId, $seats)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));

        $seatsCollection = $this->fromArray($seats);

        $conference->makeReservationForOrder(new OrderId($orderId), $seatsCollection);
    }

    public function cancelReservation($orderId, $conferenceId)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));

        $conference->cancelReservationForOrder(new OrderId($orderId));
    }

    public function confirmOrder($orderId, $conferenceId)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));
        $reservation = $conference->getReservations()->get(new ReservationId(new ConferenceId($conferenceId), new OrderId($orderId)));

        $seats = $reservation->getSeats();
        $seatsPrices = $this->getConferenceDao()->getSeatsPrices($conferenceId);

        $totalCost = $this->calculateTotalCost($seats, $seatsPrices);

        $conference->closeReservationForOrder(new OrderId($orderId));

        $approvalLink = $this->getPaypalPayments()->getApprovalLink($conference, $totalCost);

        $response = new RedirectResponse($approvalLink);
        return $response->send();
    }

    protected function fromArray($seats)
    {
        $seatsCollection = new SeatsCollection();

        foreach ($seats as $seat) {
            $seatsCollection->add(new Seat($seat['type'], $seat['quantity']));
        }

        return $seatsCollection;
    }

    protected function getConferenceRepository()
    {
        return $this->conferenceRepository;
    }

    protected function getConferenceDao()
    {
        return $this->conferenceDao;
    }

    protected function getDiscountService()
    {
        return $this->discountService;
    }

    protected function getPaypalPayments()
    {
        return $this->paypalPayments;
    }

    private function calculateTotalCost($seats, $seatsPrices)
    {
        return $this->orderCalculator->calculateTotalCost($seats, $seatsPrices);
    }
}