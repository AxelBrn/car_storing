<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ParkingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Dto\ParkingDto;

/**
 * @ApiResource(input=ParkingDto::class)
 * @ORM\Entity(repositoryClass=ParkingRepository::class)
 */
class Parking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $localisation;

    /**
     * @ORM\OneToMany(targetEntity=Car::class, mappedBy="parking")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity=ParkingSpace::class, mappedBy="parking", cascade={"persist"}, orphanRemoval=true)
     */
    private $parkingSpaces;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->parkingSpaces = new ArrayCollection();
    }

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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setParking($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getParking() === $this) {
                $car->setParking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParkingSpace[]
     */
    public function getParkingSpaces(): Collection
    {
        return $this->parkingSpaces;
    }

    public function addParkingSpace(ParkingSpace $parkingSpace): self
    {
        if (!$this->parkingSpaces->contains($parkingSpace)) {
            $this->parkingSpaces[] = $parkingSpace;
            $parkingSpace->setParking($this);
        }

        return $this;
    }

    public function removeParkingSpace(ParkingSpace $parkingSpace): self
    {
        if ($this->parkingSpaces->contains($parkingSpace)) {
            $this->parkingSpaces->removeElement($parkingSpace);
            // set the owning side to null (unless already changed)
            if ($parkingSpace->getParking() === $this) {
                $parkingSpace->setParking(null);
            }
        }

        return $this;
    }

}
