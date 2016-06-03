<?php

namespace Pfa\MainBundle\Controller;

use Pfa\MainBundle\Entity\AdvertiserType;
use Pfa\MainBundle\Entity\Gender;
use Pfa\MainBundle\Entity\MultiplePreference;
use Pfa\MainBundle\Entity\Preference;
use Pfa\MainBundle\Entity\PropertyType;
use Pfa\MainBundle\Entity\Room;
use Pfa\MainBundle\Entity\RoomInformation;
use Pfa\MainBundle\Entity\RoomInformationRoom;
use Pfa\MainBundle\Entity\RoomInformationWholeProperty;
use Pfa\MainBundle\Entity\RoomSeeker;
use Pfa\MainBundle\Entity\RoomSize;
use Pfa\MainBundle\Entity\SoloPreference;
use Pfa\MainBundle\Entity\Town;
use Pfa\MainBundle\Entity\Photo;
use Pfa\MainBundle\Form\PhotoType;
use Pfa\MainBundle\Entity\WholeProperty;
use Pfa\MainBundle\Form\WholePropertyType;
use Pfa\MainBundle\Form\RoomSeekerType;
use Pfa\MainBundle\Form\RoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="index")
     */
    public function indexAction() {
      $em = $this->getDoctrine()->getManager();

      $properties = $em->getRepository('PfaMainBundle:Property')->findAll();
      $roomseeker = $em->getRepository('PfaMainBundle:RoomSeeker')->findAll();

      $this->render('PfaMainBundle:Default:index.html.twig', array(
        'properties' => $properties,
        'roomseeker' => $roomseeker
        ));
    }

    /**
     * @Route("/showwp/{id}", name="show_whole_property")
     */
    public function showWholePropertyAction($id)
    {
    // On récupère l'EntityManager
      $em = $this
      ->getDoctrine()
      ->getManager();

      $advert = $em
      ->getRepository('PfaMainBundle:WholeProperty')
      ->find($id);

    // On vérifie que l'annonce avec cet id existe bien
      if ($advert === null) {
        throw $this->createNotFoundException("The Advert #".$id." Does Not Exist.");
      }

      $em = $this->getDoctrine()->getManager();
      $advert->setViews($advert->getViews()+1);
      $em->persist($advert);
      $em->flush();

      return $this->render('PfaMainBundle:Default:showwp.html.twig', array(
        'advert' => $advert
        ));
    }

    /**
     * @Route("/showr/{id}", name="show_room")
     */
    public function showRoomAction($id)
    {
    // On récupère l'EntityManager
      $em = $this
      ->getDoctrine()
      ->getManager();

      $advert = $em
      ->getRepository('PfaMainBundle:Room')
      ->find($id);

    // On vérifie que l'annonce avec cet id existe bien
      if ($advert === null) {
        throw $this->createNotFoundException("The Advert #".$id." Does Not Exist.");
      }

      $em = $this->getDoctrine()->getManager();
      $advert->setViews($advert->getViews()+1);
      $em->persist($advert);
      $em->flush();

      return $this->render('PfaMainBundle:Default:showr.html.twig', array(
        'advert' => $advert
        ));
    }

    /**
     * @Route("/showrs/{id}", name="show_room_seeker")
     */
    public function showRoomSeekerAction($id)
    {
    // On récupère l'EntityManager
      $em = $this
      ->getDoctrine()
      ->getManager();

      $advert = $em
      ->getRepository('PfaMainBundle:RoomSeeker')
      ->find($id);

    // On vérifie que l'annonce avec cet id existe bien
      if ($advert === null) {
        throw $this->createNotFoundException("The Advert #".$id." Does Not Exist.");
      }

      $em = $this->getDoctrine()->getManager();
      $advert->setViews($advert->getViews()+1);
      $em->persist($advert);
      $em->flush();
      
      return $this->render('PfaMainBundle:Default:showrs.html.twig', array(
        'advert' => $advert
        ));
    }

    /**
     * @Route("/addwp", name="add_whole_property")
     */
    public function addWholePropertyAction(Request $request)
    {
      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }

      $wp = new WholeProperty();
      $form = $this->createForm(new WholePropertyType(), $wp);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $wp->setPostDate(new \DateTime());
        $wp->setAdvertiser($this->container->get('security.context')->getToken()->getUser());
        $em->persist($wp);
        $em->flush();

        $url = $this->generateUrl('show_whole_property', array('id' => $wp->getId()));
        return $this->redirect($url);
      }
      return $this->render('PfaMainBundle:Default:addWholeProperty.html.twig', array(
        'form' => $form->createView(),
        'id' => 'form-submit'
        ));
    }
    /**
     * @Route("/editwp/{id}", name="edit_whole_property")
     */
    public function editWholePropertyAction($id, Request $request)
    {

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }

      $wp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PfaMainBundle:WholeProperty')
      ->find($id);

      if ($wp == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $wp->getAdvertiser()->getId())) {

        $form = $this->createForm(new WholePropertyType(), $wp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($wp);
          $em->flush();

          $url = $this->generateUrl('show_whole_property', array('id' => $wp->getId()));
          return $this->redirect($url);
        }
        return $this->render('PfaMainBundle:Default:addWholeProperty.html.twig', array(
          'form' => $form->createView(),
          'id' => 'form-submit-edit'
          ));
      } else {
        throw new AccessDeniedException('Access Denied.');
      }
    }





  /**
     * @Route("/editr/{id}", name = "edit_room")
     */
  public function editRoomAction($id, Request $request)
  {

    $usr= $this->get('security.context')->getToken()->getUser();
    if ($usr == null) {
      $url = $this->generateUrl('fos_user_security_login');
      return $this->redirect($url);
    }



    $r = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PfaMainBundle:Room')
    ->find($id);

    if ($r == null) {
      throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
    }



    if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $r->getAdvertiser()->getId())) {

      $form = $this->createForm(new RoomType(), $r);


      if((strcmp($r->getAdvertiserType()->getName(),"Propriétaire du bien") != 0) && ($r->getSelfPreference()->getUniversities() != null) ){

        $form->get('universitiesNotMapped')->setData(implode(",",$r->getSelfPreference()->getUniversities()));
      }

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();


        if(strcmp($r->getAdvertiserType()->getName(),"Propriétaire du bien") != 0){
          $univTag = $form->get("universitiesNotMapped")->getData();
          $universities = explode(",", $univTag);
          $r->getSelfPreference()->setGender($r->getTargetPreference()->getGender());
          $r->getSelfPreference()->setUniversities($universities);
        } else {
          $r->setSelfPreference(null);
        }


        $em->persist($r);
        $em->flush();

        $url = $this->generateUrl('show_room', array('id' => $r->getId()));
        return $this->redirect($url);
      }
      return $this->render('PfaMainBundle:Default:addRoom.html.twig', array(
        'form' => $form->createView(),
        'id' => 'form-submit-edit'
        ));
    } else {
      throw new AccessDeniedException('Access Denied.');
    } 
  }



    /**
     * @Route("/addr", name = "add_room")
     */
    public function addRoomAction(Request $request)
    {
      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }
      $r = new Room();
      $form = $this->createForm(new RoomType(), $r);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $r->setPostDate(new \DateTime());
        $r->setAdvertiser($this->container->get('security.context')->getToken()->getUser());


        if(strcmp($r->getAdvertiserType()->getName(),"Propriétaire du bien") != 0){
          $univTag = $form->get("universitiesNotMapped")->getData();
          $universities = explode(",", $univTag);
          $r->getSelfPreference()->setGender($r->getTargetPreference()->getGender());
          $r->getSelfPreference()->setUniversities($universities);
        } else {
          $r->setSelfPreference(null);
        }


        $em->persist($r);
        $em->flush();

        $url = $this->generateUrl('show_room', array('id' => $r->getId()));
        return $this->redirect($url);
      }
      return $this->render('PfaMainBundle:Default:addRoom.html.twig', array(
        'form' => $form->createView(),
        'id' => 'form-submit'
        ));
    }


























    /**
     * @Route("/addrs", name = "add_room_seeker")
     */
    public function addRoomSeekerAction(Request $request)
    {
      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }
      $rs = new RoomSeeker();
      $form = $this->createForm(new RoomSeekerType(), $rs);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $rs->setPostDate(new \DateTime());
        $rs->setAdvertiser($this->container->get('security.context')->getToken()->getUser());
        $rs->getSelfPreference()->setGender($rs->getTargetPreference()->getGender());

        $univTag = $form->get("universitiesNotMapped")->getData();
        $universities = explode(",", $univTag);
        $rs->getSelfPreference()->setUniversities($universities);

        $em->persist($rs);
        $em->flush();

        $url = $this->generateUrl('show_room_seeker', array('id' => $rs->getId()));
        return $this->redirect($url);
      }
      return $this->render('PfaMainBundle:Default:addRoomSeeker.html.twig', array(
        'form' => $form->createView(),
        'id' => 'form-submit'
        ));
    }











    /**
     * @Route("/editrs/{id}", name = "edit_room_seeker")
     */
    public function editRoomSeekerAction($id, Request $request)
    {

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }




      $rs = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PfaMainBundle:RoomSeeker')
      ->find($id);

      if ($rs == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $r->getAdvertiser()->getId())) {

        $form = $this->createForm(new RoomSeekerType(), $rs);
        $form->handleRequest($request);

        if($rs->getSelfPreference()->getUniversities() != null){

          $form->get('universitiesNotMapped')->setData(implode(",",$rs->getSelfPreference()->getUniversities()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();

          $rs->getSelfPreference()->setGender($rs->getTargetPreference()->getGender());

          $univTag = $form->get("universitiesNotMapped")->getData();
          $universities = explode(",", $univTag);
          $rs->getSelfPreference()->setUniversities($universities);

          $em->persist($rs);
          $em->flush();

          $url = $this->generateUrl('show_room_seeker', array('id' => $rs->getId()));
          return $this->redirect($url);
        }
        return $this->render('PfaMainBundle:Default:addRoomSeeker.html.twig', array(
          'form' => $form->createView(),
          'id' => 'form-submit-edit',
          'radius' => $rs->getRadius()
          ));
      } else {
        throw new AccessDeniedException('Access Denied.');
      }
    }





    /**
     * @Route("/deletewp/{id}", name = "delete_whole_property")
     */
    public function deleteWholePropertyAction($id){
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }

      $advert = $em->getRepository('PfaMainBundle:WholeProperty')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $advert->getAdvertiser()->getId())) {

        $em->remove($advert);

        $em->flush();

        $response = array("code" => 100, "success" => true);
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response)); 
    }


    /**
     * @Route("/deleter/{id}", name = "delete_room")
     */
    public function deleteRoomAction($id){
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }

      $advert = $em->getRepository('PfaMainBundle:Room')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $advert->getAdvertiser()->getId())) {

        $em->remove($advert);

        $em->flush();

        $response = array("code" => 100, "success" => true);
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response)); 
    }

    /**
     * @Route("/deleters/{id}", name = "delete_room_seeker")
     */
    public function deleteRoomSeekerAction($id){
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        $url = $this->generateUrl('fos_user_security_login');
        return $this->redirect($url);
      }

      $advert = $em->getRepository('PfaMainBundle:RoomSeeker')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) || ($usr->getId() == $advert->getAdvertiser()->getId())) {

        $em->remove($advert);

        $em->flush();

        $response = array("code" => 100, "success" => true);
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response)); 
    }


    /**
     * @Route("/featurewp/{id}", name = "feature_whole_property")
     */
    public function featureWholePropertyAction($id) {
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        throw new AccessDeniedException('Access Denied.');
      }

      $advert = $em->getRepository('PfaMainBundle:WholeProperty')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))) {

        if ($advert->getFeatured()) {
          $advert->setFeatured(false);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 0);
        } else {
          $advert->setFeatured(true);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 1);
        }
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response)); 

    }



    /**
     * @Route("/featurer/{id}", name = "feature_room")
     */
    public function featureRoomAction($id) {
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        throw new AccessDeniedException('Access Denied.');
      }

      $advert = $em->getRepository('PfaMainBundle:Room')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))) {

        if ($advert->getFeatured()) {
          $advert->setFeatured(false);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 0);
        } else {
          $advert->setFeatured(true);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 1);
        }
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response)); 

    }




    /**
     * @Route("/featurers/{id}", name = "feature_room_seeker")
     */
    public function featureRoomSeekerAction($id) {
      $em = $this->getDoctrine()->getManager();

      $usr= $this->get('security.context')->getToken()->getUser();
      if ($usr == null) {
        throw new AccessDeniedException('Access Denied.');
      }

      $advert = $em->getRepository('PfaMainBundle:RoomSeeker')->find($id);

      if ($advert == null) {
        throw $this->createNotFoundException("The Advert #".$id." Dos Not Exist");
      }

      if (($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))) {

        if ($advert->getFeatured()) {
          $advert->setFeatured(false);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 0);
        } else {
          $advert->setFeatured(true);
          $em->persist($advert);
          $em->flush();
          $response = array("code" => 100, "success" => true, "mode" => 1);
        }
      } else {
        throw new AccessDeniedException('Access Denied.');
      }

      return new Response(json_encode($response));

    }
  }