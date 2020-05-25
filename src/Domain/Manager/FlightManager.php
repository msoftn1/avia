<?php

namespace App\Domain\Manager;

use App\Domain\DTO\Response\AddFlight;
use App\Domain\DTO\Response\CanceledFlight;
use App\Domain\DTO\Response\CancelReservation;
use App\Domain\DTO\Response\CompletedFlight;
use App\Domain\DTO\Response\Error;
use App\Domain\DTO\Response\ResponseInterface;
use App\Domain\DTO\Response\TicketBuy;
use App\Domain\DTO\Response\TicketReturn;
use App\Domain\DTO\Response\ToBookFlight;
use App\Entity\Event;
use App\Entity\Flight;
use App\Entity\Purchase;
use App\Entity\Reservation;
use App\Util\Random;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Менеджер рейсов.
 */
class FlightManager
{
    /** Менеджер сущностей. */
    private EntityManagerInterface $entityManager;

    /** Максимальное количество мест на рейсе. */
    const MAXIMUM_SEATS = 150;

    /**
     * Конструктор.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Добавить рейс.
     *
     * @param string $name
     * @param \DateTime $flightAt
     *
     * @return ResponseInterface
     */
    public function add(string $name, \DateTime $flightAt): ResponseInterface
    {
        $flight = new Flight();
        $flight->setName($name);
        $flight->setAddedAt(new \DateTime("NOW"));
        $flight->setFlightAt($flightAt);

        $this->entityManager->persist($flight);
        $this->entityManager->flush();

        return new AddFlight(200, $flight->getId());
    }

    /**
     * Завершена продажа билетов на рейс.
     *
     * @param int $flightId
     *
     * @return ResponseInterface
     */
    public function completed(int $flightId): ResponseInterface
    {
        /** @var Flight $flight */
        $flight = $this->entityManager->find(Flight::class, $flightId);

        if ($flight === null) {
            return new Error(400, "Рейс не найден");
        }

        $flight->setIsSalesCompleted(true);
        $flight->setCompletionAt(new \DateTime("NOW"));

        $this->entityManager->persist($flight);
        $this->entityManager->flush();

        $event = new Event();
        $event->setAddedAt(new \DateTime("NOW"));
        $event->setFlight($flight);
        $event->setType(Event::EVENT_TYPE_COMPLETED);

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return new CompletedFlight(200);
    }

    /**
     * Рейс отменен.
     *
     * @param int $flightId
     *
     * @return ResponseInterface
     */
    public function canceled(int $flightId): ResponseInterface
    {
        /** @var Flight $flight */
        $flight = $this->entityManager->find(Flight::class, $flightId);

        if ($flight === null) {
            return new Error(400, "Рейс не найден");
        }

        $flight->setIsCanceled(true);
        $flight->setCancellationAt(new \DateTime("NOW"));

        $this->entityManager->persist($flight);
        $this->entityManager->flush();

        $event = new Event();
        $event->setAddedAt(new \DateTime("NOW"));
        $event->setFlight($flight);
        $event->setType(Event::EVENT_TYPE_CANCELED);

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return new CanceledFlight(200);
    }

    /**
     * Забронировать место на рейс.
     *
     * @param int $flightId
     * @param string $email
     *
     * @return ResponseInterface
     */
    public function toBook(int $flightId, string $email): ResponseInterface
    {
        /** @var Flight $flight */
        $flight = $this->entityManager->find(Flight::class, $flightId);

        if ($flight === null) {
            return new Error(400, "Рейс не найден");
        } elseif ($flight->getIsSalesCompleted()) {
            return new Error(400, "Продажа билетов на рейс окончена");
        } elseif ($flight->getIsCanceled()) {
            return new Error(400, "Рейс отменен");
        }

        try {
            $seatNumber = $this->getRandomSeatNumber();
        } catch (\Exception $e) {
            return new Error(400, $e->getMessage());
        }

        $reservation = new Reservation();
        $reservation->setFlight($flight);
        $reservation->setEmail($email);
        $reservation->setReservationAt(new \DateTime("NOW"));
        $reservation->setNumber(Random::generateRandomString(10));
        $reservation->setSeat($seatNumber);

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        return new ToBookFlight(200, $reservation->getNumber(), $reservation->getSeat());
    }

    /**
     * Отменить бронь.
     *
     * @param string $number
     *
     * @return ResponseInterface
     */
    public function cancelReservation(string $number): ResponseInterface
    {
        /** @var Reservation $reservation */
        $reservation = $this->entityManager->getRepository(Reservation::class)
            ->findOneBy(['number' => $number]);

        if ($reservation === null) {
            return new Error(400, "Бронь не найдена");
        }
        else if($reservation->getIsCanceled()) {
            return new Error(400, "Бронь уже отменена");
        }
        else if($reservation->getPurchases()->count() > 0) {
            return new Error(400, "По брони уже куплен билет");
        }

        $reservation->setIsCanceled(true);
        $reservation->setCancellationAt(new \DateTime("NOW"));

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        return new CancelReservation(200);
    }

    /**
     * Купить билет.
     *
     * @param string|null $number
     * @param int $flightId
     * @param string $email
     *
     * @return ResponseInterface
     */
    public function ticketBuy(?string $number, int $flightId, string $email): ResponseInterface
    {
        $reservation = null;

        if ($number) {
            /** @var Reservation $reservation */
            $reservation = $this->entityManager->getRepository(Reservation::class)
                ->findOneBy(['number' => $number]);

            if ($reservation === null) {
                return new Error(400, "Бронь не найдена");
            }
        }

        /** @var Flight $flight */
        $flight = $this->entityManager->find(Flight::class, $flightId);

        if ($flight === null) {
            return new Error(400, "Рейс не найден");
        } elseif ($flight->getIsSalesCompleted()) {
            return new Error(400, "Продажа билетов на рейс окончена");
        } elseif ($flight->getIsCanceled()) {
            return new Error(400, "Рейс отменен");
        } elseif ($reservation && $reservation->getPurchases()->count() > 0) {
            return new Error(400, "Билет по этой брони уже забронирован");
        }

        if(!$reservation) {
            $ret = $this->toBook($flightId, $email);

            if($ret instanceof Error) {
                return $ret;
            }

            /** @var Reservation $reservation */
            $reservation = $this->entityManager->getRepository(Reservation::class)
                ->findOneBy(['number' => $ret->toArray()['number']]);
        }

        $purchase = new Purchase();
        $purchase->setNumber(Random::generateRandomString(10));
        $purchase->setReservation($reservation);
        $purchase->setPurchaseAt(new \DateTime("NOW"));

        $this->entityManager->persist($purchase);
        $this->entityManager->flush();

        return new TicketBuy(200, $purchase->getNumber(), $reservation->getSeat());
    }

    /**
     * Вернуть билет.
     *
     * @param string $number
     *
     * @return ResponseInterface
     */
    public function ticketReturn(string $number): ResponseInterface
    {
        /** @var Purchase $purchase */
        $purchase = $this->entityManager->getRepository(Purchase::class)
            ->findOneBy(['number' => $number]);

        if ($purchase === null) {
            return new Error(400, "Билет не найден");
        }
        else if($purchase->getIsReturned()) {
            return new Error(400, "Билет уже возвращен");
        }

        $purchase->setIsReturned(true);
        $purchase->setReturnAt(new \DateTime("NOW"));

        $this->entityManager->persist($purchase);
        $this->entityManager->flush();

        return new TicketReturn(200);
    }

    /**
     * Получить рандомное место на рейсе.
     *
     * @return int
     * @throws \Exception
     */
    private function getRandomSeatNumber()
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository(Reservation::class);
        $seatList   = $repository->createQueryBuilder("r")
            ->select("r.seat")
            ->getQuery()
            ->getArrayResult();

        $seatNumbers = \array_flip(\array_map(
            fn($seat) => $seat['seat'],
            $seatList
        ));

        if (\count($seatNumbers) >= self::MAXIMUM_SEATS) {
            throw new \Exception("Все места заняты");
        }

        while(true) {
            $rndSeat = mt_rand(1,self::MAXIMUM_SEATS);

            if(!\array_key_exists($rndSeat, $seatNumbers)) {
                return $rndSeat;
            }
        }
    }
}