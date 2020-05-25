<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity рейса.
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity
 */
class Flight
{
    /**
     * Идентификатор.
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * Название рейса.
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * Дата добавления рейса.
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private $addedAt;

    /**
     * Дата рейса.
     *
     * @ORM\Column(name="flight_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $flightAt;

    /**
     * Продажи завершены.
     *
     * @ORM\Column(name="is_sales_completed", type="boolean", nullable=false)
     */
    private bool $isSalesCompleted = false;

    /**
     * Дата завершения продаж.
     *
     * @ORM\Column(name="completion_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $completionAt;

    /**
     * Рейс отменен.
     *
     * @ORM\Column(name="is_canceled", type="boolean", nullable=false)
     */
    private $isCanceled = false;

    /**
     * Дата отмены рейса.
     *
     * @ORM\Column(name="cancellation_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $cancellationAt;

    /**
     * Получить идентификатор.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Получить название рейса.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Установить название рейса.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Получить дату добавления.
     *
     * @return \DateTimeInterface
     */
    public function getAddedAt(): \DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * Установить дату добавления.
     *
     * @param \DateTimeInterface $addedAt
     *
     * @return $this
     */
    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Получить дату рейса.
     *
     * @return \DateTimeInterface
     */
    public function getFlightAt(): \DateTimeInterface
    {
        return $this->flightAt;
    }

    /**
     * Установить дату рейса.
     *
     * @param \DateTimeInterface $flightAt
     *
     * @return $this
     */
    public function setFlightAt(\DateTimeInterface $flightAt): self
    {
        $this->flightAt = $flightAt;

        return $this;
    }

    /**
     * Получить признак завершения продаж.
     *
     * @return bool
     */
    public function getIsSalesCompleted(): bool
    {
        return $this->isSalesCompleted;
    }

    /**
     * Установить признак завершения продаж.
     *
     * @param bool $isSalesCompleted
     *
     * @return $this
     */
    public function setIsSalesCompleted(bool $isSalesCompleted): self
    {
        $this->isSalesCompleted = $isSalesCompleted;

        return $this;
    }

    /**
     * Получить дату завершения продаж билетов на рейс.
     *
     * @return \DateTimeInterface|null
     */
    public function getCompletionAt(): ?\DateTimeInterface
    {
        return $this->completionAt;
    }

    /**
     * Установить дату завершения продаж билетов на рейс.
     *
     * @param \DateTimeInterface|null $completionAt
     *
     * @return $this
     */
    public function setCompletionAt(?\DateTimeInterface $completionAt): self
    {
        $this->completionAt = $completionAt;

        return $this;
    }

    /**
     * Получить признак отмены рейса.
     *
     * @return bool
     */
    public function getIsCanceled(): bool
    {
        return $this->isCanceled;
    }

    /**
     * Установить признак отмены рейса.
     *
     * @param bool $isCanceled
     *
     * @return $this
     */
    public function setIsCanceled(bool $isCanceled): self
    {
        $this->isCanceled = $isCanceled;

        return $this;
    }

    /**
     * Получить дату отмены рейса.
     *
     * @return \DateTimeInterface|null
     */
    public function getCancellationAt(): ?\DateTimeInterface
    {
        return $this->cancellationAt;
    }

    /**
     * Установить дату отмены рейса.
     *
     * @param \DateTimeInterface|null $cancellationAt
     *
     * @return $this
     */
    public function setCancellationAt(?\DateTimeInterface $cancellationAt): self
    {
        $this->cancellationAt = $cancellationAt;

        return $this;
    }
}
