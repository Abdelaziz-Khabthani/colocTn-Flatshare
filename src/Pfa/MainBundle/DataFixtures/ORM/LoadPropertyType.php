<?php

namespace Pfa\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfa\MainBundle\Entity\PropertyType;

class LoadPropertyType implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $types = array(
      'Appartemant',
      'Villa',
      'Studio'
    );

    foreach ($types as $type) {
      $propertyType = new PropertyType();
      $propertyType->setName($type);
      $manager->persist($propertyType);
    }
    $manager->flush();
  }
}