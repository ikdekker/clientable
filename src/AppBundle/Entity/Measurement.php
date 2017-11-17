<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Measurement
 *
 * @ORM\Table(name="measurement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeasurementRepository")
 */
class Measurement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="client", type="integer")
     */
    private $client;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;
    
    /**
     * @var float
     *
     * @ORM\Column(name="bmi", type="float")
     */
    private $bmi;
    
    /**
     * @var float
     *
     * @ORM\Column(name="fatPercentage", type="float")
     */
    private $fatPercentage;
    
    /**
     * @var float
     *
     * @ORM\Column(name="muscleMass", type="float")
     */
    private $muscleMass;
    
    /**
     * @var float
     *
     * @ORM\Column(name="visceralFat", type="float")
     */
    private $visceralFat;
    
    /**
     * @var float
     *
     * @ORM\Column(name="kcal", type="float")
     */
    private $kcal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    
    
    public function __construct() {
        $this->date = new \DateTime(); 
    }
     
    public function getBmi() {
        return $this->bmi;
    }

    public function getFatPercentage() {
        return $this->fatPercentage;
    }

    public function getMuscleMass() {
        return $this->muscleMass;
    }

    public function getVisceralFat() {
        return $this->visceralFat;
    }

    public function getKcal() {
        return $this->kcal;
    }

    public function setBmi($bmi) {
        $this->bmi = $bmi;
        return $this;
    }

    public function setFatPercentage($fatPercentage) {
        $this->fatPercentage = $fatPercentage;
        return $this;
    }

    public function setMuscleMass($muscleMass) {
        $this->muscleMass = $muscleMass;
        return $this;
    }

    public function setVisceralFat($visceralFat) {
        $this->visceralFat = $visceralFat;
        return $this;
    }

    public function setKcal($kcal) {
        $this->kcal = $kcal;
        return $this;
    }

        
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param integer $client
     *
     * @return Measurement
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return Measurement
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Measurement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

