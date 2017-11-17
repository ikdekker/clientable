<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="targetWeight", type="float", nullable=true)
     */
    private $targetWeight; 

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float", nullable=true)
     */
    private $height; 

    /**
     * @var float
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;
    
   /**
     * @var float
     *
     * @ORM\Column(name="initialWeight", type="float", nullable=true)
     */
    private $initialWeight;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="initialDate", type="datetime")
     */
    private $initialDate;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="middleName", type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="measurements", type="string", length=255, nullable=true)
     */
    private $measurements;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=2000, nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="diet", type="text", length=2000, nullable=true)
     */
    private $diet; // bijzonderheden

    /**
     * @var string
     *
     * @ORM\Column(name="agreements", type="text", length=2000, nullable=true)
     */
    private $agreements; // afspraken 
    
    public function getTargetWeight() {
        return $this->targetWeight;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getDiet() {
        return $this->diet;
    }

    public function getAgreements() {
        return $this->agreements;
    }

    public function setTargetWeight($targetWeight) {
        $this->targetWeight = $targetWeight;
        return $this;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
        return $this;
    }

    public function setDiet($diet) {
        $this->diet = $diet;
        return $this;
    }

    public function setAgreements($agreements) {
        $this->agreements = $agreements;
        return $this;
    }
    
    public function getNotes() {
        return $this->notes;
    }

    public function getInitialDate() {
        return $this->initialDate;
    }

    public function setInitialDate(\DateTime $initialDate) {
        $this->initialDate = $initialDate;
        return $this;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set initialWeight
     *
     * @param float $initialWeight
     *
     * @return Client
     */
    public function setInitialWeight($initialWeight) {
        $this->initialWeight = $initialWeight;

        return $this;
    }

    /**
     * Get initialWeight
     *
     * @return float
     */
    public function getInitialWeight() {
        return $this->initialWeight;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Client
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Client
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return Client
     */
    public function setMiddleName($middleName) {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName() {
        return $this->middleName;
    }

    /**
     * Set measurements
     *
     * @param string $measurements
     *
     * @return Client
     */
    public function setMeasurements($measurements) {
        $this->measurements = $measurements;

        return $this;
    }

    /**
     * Get measurements
     *
     * @return string
     */
    public function getMeasurements() {
        return $this->measurements;
    }

}
