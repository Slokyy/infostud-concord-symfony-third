<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table('driver_vehicle')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Driver::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $driver;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]

    private $vehicle;

    #[ORM\Column(type: 'date')]
    private $date_reserved;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getDateReserved(): ?\DateTimeInterface
    {
        return $this->date_reserved;
    }

    public function setDateReserved(\DateTimeInterface $date_reserved): self
    {
        $this->date_reserved = $date_reserved;

        return $this;
    }
}
