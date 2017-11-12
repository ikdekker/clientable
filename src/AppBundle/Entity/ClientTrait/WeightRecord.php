<?php

namespace AppBundle\Entity\Person;

/**
 * Weight
 */
class WeightRecord {

    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $userId;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return Weight
     */
    public function setWeight($weight) {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Weight
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

}
