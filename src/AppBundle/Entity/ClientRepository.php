<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends EntityRepository {

    public function getMeasurements($id) {
        $em = new \Doctrine\ORM\EntityManager();

        $repo = $em->getRepository(Measurement::class);
        $measurements = $repo->findBy(['client' => $id]);

        return $measurements;
    }

}