<?php

namespace App\Command;

use App\Domain\Manager\EventManager;
use App\Domain\Manager\RatingManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  Класс команды для обработки событий.
 */
class NotificationsBuilderCommand extends Command
{
    /** @var string Адрес команды. */
    protected static $defaultName = 'app:notifications:builder';

    /** Менеджер событий. */
    private EventManager $eventManager;

    /**
     * Конструктор.
     *
     * @param EventManager $eventManager
     */
    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $ret = $this->eventManager->processEvents();

            $output->writeln(\sprintf("Обработано событий: %s. Сгенерировано уведомлений: %s", $ret->getCntEvents(), $ret->getCntNotification()));
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }
}
