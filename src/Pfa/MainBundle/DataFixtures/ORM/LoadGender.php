<?php

namespace Pfa\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfa\MainBundle\Entity\Gender;

class LoadGender implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $genderNames = array(
      'Male',
      'Female'
    );

    foreach ($genderNames as $genderName) {
      $gender = new Gender();
      $gender->setName($genderName);
      $manager->persist($gender);
    }
    $manager->flush();
  }
}