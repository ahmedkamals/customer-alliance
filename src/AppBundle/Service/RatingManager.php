<?php

namespace AppBundle\Service;

use AppBundle\Entity\Rating;
use Doctrine\ORM\EntityManager;

/**
 * Class RatingManager
 * @package AppBundle\Service
 */
class RatingManager
{
    /** @var EntityManager  */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $uuid
     *
     * @return int
     */
    public function getRating(string $uuid): int
    {
        /** @var []Rating **/
        $scores = $this->entityManager->getRepository('AppBundle:Rating')
            ->findBy([
                'userId' => $uuid
            ]);

        $count = 0;
        $sum = 0;

        if (count($scores) > 0) {

            /** @var Rating $score */
            foreach ($scores as $score) {
                $sum += $score->getScore();
                $count++;
            }
        }

        return $count > 0? round($sum / $count) : $sum;
    }
}