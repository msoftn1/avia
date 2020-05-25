<?php

namespace App\Controller\Api;

use App\Domain\DTO\Response\Error;
use App\Domain\Manager\FlightManager;
use App\Domain\Validation\Validator\AddFlightValidator;
use App\Domain\Validation\Validator\CompletedFlightValidator;
use App\Domain\Validation\Validator\СanceledFlightValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Контроллер API администрирования.
 */
class SystemController extends AbstractController
{
    /** Менеджер рейсов. */
    private FlightManager $flightManager;

    /** Ключ API. */
    private string $apiKey;

    /**
     * Конструктор.
     *
     * @param FlightManager      $flightManager
     * @param ContainerInterface $container
     */
    public function __construct(FlightManager $flightManager, ContainerInterface $container)
    {
        $this->flightManager = $flightManager;
        $this->apiKey        = $container->getParameter("api_key");
    }

    /**
     * Добавить рейс.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/add")
     */
    public function add(Request $request): Response
    {
        $name     = $request->get("name");
        $flightAt = $request->get("flight_at");

        $validator = new AddFlightValidator(
            $name,
            $flightAt,
            $request->get("secret_key")
        );

        $validator->setCheckKey($this->apiKey);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $flightDt = new \DateTime();
            $flightDt->setTimestamp((int)$flightAt);

            $ret = $this->flightManager->add($name, $flightDt);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Завершена продажа билетов на рейс.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/completed")
     */
    public function completed(Request $request): Response
    {
        $flightId = $request->get("flight_id");

        $validator = new CompletedFlightValidator(
            $flightId,
            $request->get("secret_key")
        );

        $validator->setCheckKey($this->apiKey);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->completed($flightId);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Рейс отменен.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/api/v1/flights/canceled")
     */
    public function canceled(Request $request): Response
    {
        $flightId = $request->get("flight_id");

        $validator = new СanceledFlightValidator(
            $flightId,
            $request->get("secret_key")
        );

        $validator->setCheckKey($this->apiKey);

        $validatorResult = $validator->validate();

        if (!$validatorResult->isSuccess()) {
            $ret = new Error(400, $validatorResult->getReason());
        } else {
            $ret = $this->flightManager->canceled($flightId);
        }

        $response = new Response(\json_encode($ret->toArray()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
