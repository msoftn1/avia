<?php

namespace App\Command;

use App\Domain\Manager\EventManager;
use App\Domain\Manager\NotificationManager;
use App\Domain\Manager\RatingManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  Класс команды для отправки уведомлений.
 */
class NotificationsSenderCommand extends Command
{
    /** @var string Адрес команды. */
    protected static $defaultName = 'app:notifications:sender';

    /** Менеджер событий. */
    private NotificationManager $notificationManager;

    /**
     * Конструктор.
     *
     * @param NotificationManager $notificationManager
     */
    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $ret = $this->notificationManager->processNotifications();

            $output->writeln(\sprintf("Обработано уведомлений: %s", $ret));
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }
}
