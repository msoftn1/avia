<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity
 */
class Flight
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private $addedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="flight_at", type="datetime", nullable=false)
     */
    private $flightAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_sales_completed", type="boolean", nullable=false)
     */
    private $isSalesCompleted = false;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="completion_at", type="datetime", nullable=true)
     */
    private $completionAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_canceled", type="boolean", nullable=false)
     */
    private $isCanceled = false;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cancellation_at", type="datetime", nullable=true)
     */
    private $cancellationAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getFlightAt(): ?\DateTimeInterface
    {
        return $this->flightAt;
    }

    public function setFlightAt(\DateTimeInterface $flightAt): self
    {
        $this->flightAt = $flightAt;

        return $this;
    }

    public function getIsSalesCompleted(): ?bool
    {
        return $this->isSalesCompleted;
    }

    public function setIsSalesCompleted(bool $isSalesCompleted): self
    {
        $this->isSalesCompleted = $isSalesCompleted;

        return $this;
    }

    public function getCompletionAt(): ?\DateTimeInterface
    {
        return $this->completionAt;
    }

    public function setCompletionAt(?\DateTimeInterface $completionAt): self
    {
        $this->completionAt = $completionAt;

        return $this;
    }

    public function getIsCanceled(): ?bool
    {
        return $this->isCanceled;
    }

    public function setIsCanceled(bool $isCanceled): self
    {
        $this->isCanceled = $isCanceled;

        return $this;
    }

    public function getCancellationAt(): ?\DateTimeInterface
    {
        return $this->cancellationAt;
    }

    public function setCancellationAt(?\DateTimeInterface $cancellationAt): self
    {
        $this->cancellationAt = $cancellationAt;

        return $this;
    }


}
