<?php

namespace Pfa\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfa\MainBundle\Entity\Town;

class LoadTown implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $towns = array(
      'Ariana',
      'Béja',
      'Ben Arous',
      'Bizert',
      'Gabés',
      'Gafsa',
      'Jendouba',
      'Kairouane',
      'Kébili',
      'Kef',
      'Mahdia',
      'La Manouba',
      'Médenine',
      'Monastir',
      'Nabeul',
      'Sfax',
      'Sidi Bouzid',
      'Siliana',
      'Sousse',
      'Tatouine',
      'Tozeur',
      'Tunis',
      'Zaghouan'
    );

    foreach ($towns as $townName) {
      $town = new Town();
      $town->setName($townName);
      $manager->persist($town);
    }
    $manager->flush();
  }
}