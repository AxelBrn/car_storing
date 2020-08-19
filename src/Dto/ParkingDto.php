<?php
// src/Dto/ParkingDto.php

namespace App\Dto;

final class ParkingDto {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $localisation;

    /**
     * @var int
     */
    private $nbParkingSpaces;

    /**
     * @var float
     */
    private $height;
    
    /**
     * @var float
     */
    private $width;

    

    /**
     * Get the value of width
     *
     * @return  float
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @param  float  $width
     *
     * @return  self
     */ 
    public function setWidth(float $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     *
     * @return  float
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @param  float  $height
     *
     * @return  self
     */ 
    public function setHeight(float $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of nbParkingSpaces
     *
     * @return  int
     */ 
    public function getNbParkingSpaces()
    {
        return $this->nbParkingSpaces;
    }

    /**
     * Set the value of nbParkingSpaces
     *
     * @param  int  $nbParkingSpaces
     *
     * @return  self
     */ 
    public function setNbParkingSpaces(int $nbParkingSpaces)
    {
        $this->nbParkingSpaces = $nbParkingSpaces;

        return $this;
    }

    /**
     * Get the value of localisation
     *
     * @return  string
     */ 
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set the value of localisation
     *
     * @param  string  $localisation
     *
     * @return  self
     */ 
    public function setLocalisation(string $localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}