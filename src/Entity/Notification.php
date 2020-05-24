<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="notification_event_id_index", columns={"event_id"}), @ORM\Index(name="notification_reservation_id_index", columns={"reservation_id"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private $addedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_processed", type="boolean", nullable=false)
     */
    private $isProcessed = false;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="processed_at", type="datetime", nullable=true)
     */
    private $processedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_attempt_at", type="datetime", nullable=true)
     */
    private $lastAttemptAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="last_response_code", type="integer", nullable=true)
     */
    private $lastResponseCode;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="count_attempts", type="int", nullable=true)
     */
    private $countAttempts = 0;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @var \Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    public function getIsProcessed(): ?bool
    {
        return $this->isProcessed;
    }

    public function setIsProcessed(bool $isProcessed): self
    {
        $this->isProcessed = $isProcessed;

        return $this;
    }

    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getLastAttemptAt(): ?\DateTimeInterface
    {
        return $this->lastAttemptAt;
    }

    public function setLastAttemptAt(?\DateTimeInterface $lastAttemptAt): self
    {
        $this->lastAttemptAt = $lastAttemptAt;

        return $this;
    }

    public function getLastResponseCode(): ?int
    {
        return $this->lastResponseCode;
    }

    public function setLastResponseCode(?int $lastResponseCode): self
    {
        $this->lastResponseCode = $lastResponseCode;

        return $this;
    }

    public function getCountAttempts()
    {
        return $this->countAttempts;
    }

    public function setCountAttempts($countAttempts): self
    {
        $this->countAttempts = $countAttempts;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }


}
