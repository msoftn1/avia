<?php

namespace App\Controller\Api;

use App\Domain\DTO\Response\Error;
use App\Domain\Manager\FlightManager;
use App\Domain\Validation\Validator\AddFlightValidator;
use App\Domain\Validation\Validator\CompletedFlightValidator;
use App\Domain\Validation\Validator\TicketBuyValidator;
use App\Domain\Validation\Validator\TicketReturnValidator;
use App\Domain\Validation\Validator\ToBookFlightValidator;
use App\Domain\Validation\Validator\СanceledFlightValidator;
use App\Domain\Validation\Validator\СancelReservationValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Контроллер API для покупателей билетов.
 */
class UserController extends AbstractController
{
    private FlightManager $flightManager;

    public function __construct(FlightManager $flightManager)
    {
        $this->flightManager = $flightManager;
    }

    /**
     * Забронировать.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/reservation/to_book")
     */
    public function toBook(Request $request): Response
    {
        $flightId = $request->get("flight_id");
        $email = $request->get("email");
        $callbackUrl = $request->get("callback_url");

        $validator = new ToBookFlightValidator(
            $flightId,
            $email,
            $callbackUrl
        );

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->toBook($flightId, $email, $callbackUrl);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Отменить бронь.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/reservation/cancel")
     */
    public function cancelReservation(Request $request): Response
    {
        $number = $request->get("number");
        $validator = new СancelReservationValidator($number);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->cancelReservation($number);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Купить билет.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/ticket/buy")
     */
    public function ticketBuy(Request $request): Response
    {
        $number = $request->get("number");
        $flightId = $request->get("flight_id");
        $email = $request->get("email");
        $callbackUrl = $request->get("callback_url");

        $validator = new TicketBuyValidator($number, $flightId, $email, $callbackUrl);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->ticketBuy($number, $flightId, $email, $callbackUrl);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Вернуть билет.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/ticket/return")
     */
    public function ticketReturn(Request $request): Response
    {
        $number = $request->get("number");
        $validator = new TicketReturnValidator($number);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->ticketReturn($number);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
