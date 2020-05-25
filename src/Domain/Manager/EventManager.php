<?php

namespace App\Domain\Manager;


use App\Domain\DTO\ProcessEvents;
use App\Entity\Event;
use App\Entity\Notification;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Менеджер событий.
 */
class EventManager
{
    /** Менеджер сущностей. */
    private EntityManagerInterface $entityManager;

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
     * Обработка событий и генерация уведомлений.
     *
     * @return ProcessEvents
     */
    public function processEvents(): ProcessEvents
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository(Event::class);

        /** @var Event[] $events */
        $events = $repository->createQueryBuilder("e")
            ->where('e.isProcessed=:isProcessed')
            ->setParameter('isProcessed', false)
            ->getQuery()
            ->getResult();

        $cntNotifications = 0;

        foreach ($events as $event) {
            if ($event->getType() === Event::EVENT_TYPE_COMPLETED) {
                $cntNotifications += $this->processEventCompleted($event);
            }
            elseif($event->getType() === Event::EVENT_TYPE_CANCELED) {
                $cntNotifications += $this->processEventCanceled($event);
            }
        }

        return new ProcessEvents(\count($events), $cntNotifications);
    }

    /**
     * Генерация уведомлений для события завершения продажи билетов.
     *
     * @param Event $event
     *
     * @return int
     */
    private function processEventCompleted(Event $event): int
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository(Reservation::class);

        $reservations = $repository->createQueryBuilder("r")
            ->leftJoin("r.purchases", 'p')
            ->where('p IS NULL')
            ->andWhere('r.flight=:flight')
            ->setParameter('flight', $event->getFlight())
            ->getQuery()
            ->getResult();

        foreach ($reservations as $reservation) {
            $notification = new Notification();
            $notification->setAddedAt(new \DateTime("NOW"));
            $notification->setReservation($reservation);
            $notification->setEvent($event);

            $this->entityManager->persist($notification);
        }

        $event->setIsProcessed(true);

        $this->entityManager->flush();

        return \count($reservations);
    }

    /**
     * Генерация уведомлений для события отмены рейса.
     *
     * @param Event $event
     *
     * @return int
     */
    private function processEventCanceled(Event $event): int
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository(Reservation::class);

        $reservations = $repository->createQueryBuilder("r")
            ->leftJoin("r.purchases", 'p')
            ->where('p IS NOT NULL')
            ->andWhere('r.flight=:flight')
            ->setParameter('flight', $event->getFlight())
            ->getQuery()
            ->getResult();

        foreach ($reservations as $reservation) {
            $notification = new Notification();
            $notification->setAddedAt(new \DateTime("NOW"));
            $notification->setReservation($reservation);
            $notification->setEvent($event);

            $this->entityManager->persist($notification);
        }

        $event->setIsProcessed(true);

        $this->entityManager->flush();

        return \count($reservations);
    }
}