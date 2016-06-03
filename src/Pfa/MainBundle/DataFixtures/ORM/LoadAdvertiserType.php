<?php

namespace Pfa\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfa\MainBundle\Entity\AdvertiserType;

class LoadAdvertiserType implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $types = array(
      'Etudiant (Collocation)',
      'Propriétaire du bien'
    );

    foreach ($types as $type) {
      $advertiserType = new AdvertiserType();
      $advertiserType->setName($type);
      $manager->persist($advertiserType);
    }
    $manager->flush();
  }
}