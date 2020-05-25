<?php
namespace App\Domain\Manager;

use App\Entity\Event;
use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Менеджер обработки уведомлений.
 */
class NotificationManager
{
    /** Менеджер сущностей. */
    private EntityManagerInterface $entityManager;

    /** Мейлер. */
    private MailerInterface $mailer;

    /** Email администратора */
    private string $adminEmail;

    /**
     * Конструктор.
     *
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface        $mailer
     * @param ContainerInterface     $container
     */
    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->mailer        = $mailer;
        $this->adminEmail    = $container->getParameter("admin_email");
    }

    /**
     * Отсылка уведомлений находящися в статусе "не обработано".
     *
     * @return int
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function processNotifications(): int
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository(Notification::class);

        /** @var Notification[] $notifications */
        $notifications = $repository->createQueryBuilder("n")
            ->leftJoin("n.event", 'e')
            ->leftJoin("n.reservation", 'r')
            ->leftJoin("r.flight", 'f')
            ->where('n.isProcessed=:isProcessed')
            ->setParameter('isProcessed', false)
            ->getQuery()
            ->getResult();

        foreach ($notifications as $notification) {
            $event  = $notification->getEvent();
            $flight = $notification->getReservation()->getFlight();

            if ($event->getType() === Event::EVENT_TYPE_COMPLETED) {
                $message = \sprintf('Продажа билетов на рейс %s завершена', $flight->getId());
            } elseif ($event->getType() === Event::EVENT_TYPE_CANCELED) {
                $message = \sprintf('Рейс %s отменен', $flight->getId());
            } else {
                continue;
            }

            $email = (new Email())
                ->from($this->adminEmail)
                ->to($notification->getReservation()->getEmail())
                ->subject($message)
                ->text($message);

            $this->mailer->send($email);

            $notification->setIsProcessed(true);
            $notification->setProcessedAt(new \DateTime("NOW"));

            $this->entityManager->persist($notification);
            $this->entityManager->flush();
        }

        return \count($notifications);
    }
}