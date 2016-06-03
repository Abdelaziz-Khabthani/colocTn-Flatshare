<?php

namespace Pfa\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfa\MainBundle\Entity\RoomSize;

class LoadRoomSize implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $types = array(
      'Single',
      'Double'
    );

    foreach ($types as $type) {
      $roomSize = new RoomSize();
      $roomSize->setName($type);
      $manager->persist($roomSize);
    }
    $manager->flush();
  }
}