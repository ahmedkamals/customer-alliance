<?php

namespace AppBundle\Repository;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $uuid
     *
     * @return int
     */
    public function getAverageRating(string $uuid): int
    {
        $score = $this->createQueryBuilder('r')
            ->select("avg(r.score) as score_avg")
            ->where('r.userId = :userId')
            ->setParameter('userId', $uuid)
            ->getQuery()
            ->getSingleScalarResult();

        return round($score);
    }
}
