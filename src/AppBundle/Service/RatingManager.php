<?php

namespace AppBundle\Service;

use AppBundle\Entity\Rating;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RatingManager
 * @package AppBundle\Service
 */
class RatingManager
{
    /** @var EntityManagerInterface  */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
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

        return $sum > 0? round($sum / $count) : 0;
    }
}