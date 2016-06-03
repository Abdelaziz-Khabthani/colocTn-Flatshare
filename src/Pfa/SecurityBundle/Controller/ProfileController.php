<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pfa\SecurityBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction($type, $page)
    {
        $nbPerPage = 5;

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        switch ($type) {
            case 'bienentier':
            $adverts = $em->getRepository('PfaMainBundle:WholeProperty')->getByUSerId($user->getId(), $page, $nbPerPage);
            break;
            case 'chercheur':
            $adverts = $em->getRepository('PfaMainBundle:RoomSeeker')->getByUSerId($user->getId(), $page, $nbPerPage);
            break;
            case 'chambre':
            $adverts = $em->getRepository('PfaMainBundle:Room')->getByUSerId($user->getId(), $page, $nbPerPage, 0);
            break;
            case 'collocation':
            $adverts = $em->getRepository('PfaMainBundle:Room')->getByUSerId($user->getId(), $page, $nbPerPage, 1);
            break;
        }

        if (count($adverts) == 0) {
                $nbPages = 1;
                $searchResult = 0;
            } else {
                $nbPages = ceil(count($adverts)/$nbPerPage);
            }

            if (($page > $nbPages)) {
                throw $this->createNotFoundException("The Page ".$page." Does Not Exist.");
            }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'nbPages' => $nbPages,
            'page' => $page,
            'adverts' => $adverts,
            'type' => $type
            ));
    }

    public function allAction($type, $page)
    {
        $nbPerPage = 5;

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        switch ($type) {
            case 'bienentier':
            $adverts = $em->getRepository('PfaMainBundle:WholeProperty')->findAllPage($page, $nbPerPage);
            break;
            case 'chercheur':
            $adverts = $em->getRepository('PfaMainBundle:RoomSeeker')->findAllPage($page, $nbPerPage);
            break;
            case 'chambre':
            $adverts = $em->getRepository('PfaMainBundle:Room')->findAllPage($page, $nbPerPage, 0);
            break;
            case 'collocation':
            $adverts = $em->getRepository('PfaMainBundle:Room')->findAllPage($page, $nbPerPage, 1);
            break;
        }
        if (count($adverts) == 0) {
                $nbPages = 1;
                $searchResult = 0;
            } else {
                $nbPages = ceil(count($adverts)/$nbPerPage);
            }

            if (($page > $nbPages)) {
                throw $this->createNotFoundException("The Page ".$page." Does Not Exist.");
            }

        return $this->render('FOSUserBundle:Profile:all.html.twig', array(
            'user' => $user,
            'nbPages' => $nbPages,
            'page' => $page,
            'adverts' => $adverts,
            'type' => $type
            ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
            ));
    }
}
