<?php
namespace Php\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('admin@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $userManager->updateUser($user, true);
        $user = null;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('user1@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('User1');
        $user->setLastName('USer1');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user, true);
        $user = null;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('user2@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('User2');
        $user->setLastName('USer2');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user, true);
        $user = null;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('user3@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('User3');
        $user->setLastName('USer3');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user, true);
        $user = null;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('user4@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('User4');
        $user->setLastName('USer4');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user, true);
        $user = null;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $user = $userManager->createUser();
        $user->setEmail('user5@pfa.com');
        $user->setPlainPassword('azerty');
        $user->setFirstName('User5');
        $user->setLastName('USer5');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user, true);
        $user = null;
    }
}