<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity покупки билета.
 *
 * @ORM\Table(name="purchase", indexes={@ORM\Index(name="purchase_number", columns={"number"}), @ORM\Index(name="purchase_reservation_id", columns={"reservation_id"})})
 * @ORM\Entity
 */
class Purchase
{
    /**
     * Идентификатор покупки.
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * Дата покупки.
     *
     * @ORM\Column(name="purchase_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $purchaseAt;

    /**
     * Номер бронирования.
     *
     * @ORM\Column(name="number", type="string", length=10, nullable=false)
     */
    private string $number;

    /**
     * Признак возврата билета.
     *
     * @ORM\Column(name="is_returned", type="boolean", nullable=false)
     */
    private bool $isReturned = false;

    /**
     * Дата возврата билета.
     *
     * @ORM\Column(name="return_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $returnAt;

    /**
     * Бронь.
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private Reservation $reservation;

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
     * Получить дату покупки.
     *
     * @return \DateTime
     */
    public function getPurchaseAt(): \DateTimeInterface
    {
        return $this->purchaseAt;
    }

    /**
     * Установить дату покупки.
     *
     * @param \DateTimeInterface $purchaseAt
     *
     * @return $this
     */
    public function setPurchaseAt(\DateTimeInterface $purchaseAt): self
    {
        $this->purchaseAt = $purchaseAt;

        return $this;
    }

    /**
     * Получить номер брони.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Установить номер брони.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Получить признак возврата билета.
     *
     * @return bool
     */
    public function getIsReturned(): bool
    {
        return $this->isReturned;
    }

    /**
     * Установить признак возврата билета.
     *
     * @param bool $isReturned
     *
     * @return $this
     */
    public function setIsReturned(bool $isReturned): self
    {
        $this->isReturned = $isReturned;

        return $this;
    }

    /**
     * Получить дату возврата билета.
     *
     * @return \DateTimeInterface|null
     */
    public function getReturnAt(): ?\DateTimeInterface
    {
        return $this->returnAt;
    }

    /**
     * Установить дату возврата билета.
     *
     * @param \DateTimeInterface|null $returnAt
     *
     * @return $this
     */
    public function setReturnAt(?\DateTimeInterface $returnAt): self
    {
        $this->returnAt = $returnAt;

        return $this;
    }

    /**
     * Получить бронь.
     *
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    /**
     * Установить бронь.
     *
     * @param Reservation $reservation
     *
     * @return $this
     */
    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
