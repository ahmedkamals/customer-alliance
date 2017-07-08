<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Rating;
use AppBundle\Repository\RatingRepository;
use AppBundle\Service\RatingManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class RatingManagerTest
 * @package AppBundle\Service
 */
class RatingManagerTest extends TestCase
{
    /**
     * @return array
     */
    public function scoreAverageDataProvider(): array
    {
        return [
            'Result should be rounded' => [
                'uuid' => '001442e5-dd05-11e3-93c8-d43d7eecedd2',
                'ratings' => $this->getDummyRatings([5, 10, 12, 3]),
                'expected' => 8,
            ],
            'Result should be zero' => [
                'uuid' => '001442e5-dd05-11e3-93c8-d43d7eecedd3',
                'ratings' => $this->getDummyRatings([]),
                'expected' => 0,
            ],
        ];
    }

    /**
     * @param string $uuid
     * @param array  $ratings
     * @param int    $expected
     *
     * @dataProvider scoreAverageDataProvider
     */
    public function testShouldCalculateScoreAverageCorrectly(
        string $uuid,
        array $ratings,
        int $expected
    )
    {
        $ratingRepository = $this
            ->getMockBuilder(RatingRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $ratingRepository->expects($this->once())
            ->method('findBy')
            ->will($this->returnValue($ratings));

        $entityManager = $this
            ->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($ratingRepository));

        $ratingManager = new RatingManager($entityManager);
        $this->assertEquals($expected, $ratingManager->getRating($uuid));
    }

    /**
     * @param array $ratings
     *
     * @return array
     */
    public function getDummyRatings(array $ratings): array
    {
        $result = [];

        foreach ($ratings as $rating) {
            $result[] = (new Rating())->setScore($rating);
        }

        return $result;
    }
}