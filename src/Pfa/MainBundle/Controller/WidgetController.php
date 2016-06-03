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

class WidgetController extends Controller {

	public function latestAdvertsAllAction($limit){
		$em = $this->getDoctrine()->getManager();

		$advertsProperty = $em->getRepository('PfaMainBundle:Property')
		->findBy(
			array(),
			array('postDate' => 'DESC'),
			$limit,
			0
			);

		$advertsRoomSeeker = $em->getRepository('PfaMainBundle:RoomSeeker')
		->findBy(
			array(),
			array('postDate' => 'DESC'),
			$limit,
			0
			);

		return $this->render('PfaMainBundle:Widget:footerWidget.html.twig', array('advertsProperty' => $advertsProperty, 'advertsRoomSeeker' => $advertsRoomSeeker));
	}

	public function latestAdvertsAction($limit, $type){
		$em = $this->getDoctrine()->getManager();
		$keyword = "Latest";

		$adverts = $em
		->getRepository('PfaMainBundle:'.$type)
		->findBy(
			array(),
			array('postDate' => 'DESC'),
			$limit,
			0
			);
		return $this->render('PfaMainBundle:Widget:widget.html.twig', array(
			'keyword' => $keyword,
			'type' => $type,
			'adverts' => $adverts
			));
	}

	public function featuredAdvertsAction($limit, $type){
		$em = $this->getDoctrine()->getManager();
		$keyword = 'Featured';

		$adverts = $em
		->getRepository('PfaMainBundle:'.$type)
		->findBy(
			array('featured' => true),
			array('postDate' => 'DESC'),
			$limit,
			0
			);

		return $this->render('PfaMainBundle:Widget:widget.html.twig', array(
			'keyword' => $keyword,
			'type' => $type,
			'adverts' => $adverts
			));
	}

	public function similarAdvertsAction($limit, $type, $id){
		$em = $this->getDoctrine()->getManager();

		$keyword = 'Similar';
		$advertTobeSimilarTo = $em->getRepository('PfaMainBundle:'.$type)->find($id);

		switch ($advertTobeSimilarTo::TYPE) {
			case 'WHOLE_PROPERTY':
				$adverts = $em->getRepository('PfaMainBundle:WholeProperty')
				->getSimilarAdverts(
					$advertTobeSimilarTo->getPrice(),
					$advertTobeSimilarTo->getTown(),
					$advertTobeSimilarTo->getPropertyType(),
					$advertTobeSimilarTo->getId(),
					3
				);
			break;
			case 'ROOM':
				$adverts = $em->getRepository('PfaMainBundle:Room')
				->getSimilarAdverts(
					$advertTobeSimilarTo->getTown(),
					$advertTobeSimilarTo->getPropertyType(),
					$advertTobeSimilarTo->getAdvertiserType(),
					$advertTobeSimilarTo->getTargetPreference()->getGender(),
					$advertTobeSimilarTo->getId(),
					3
				);
			break;
			case 'ROOM_SEEKER':
				$adverts = $em->getRepository('PfaMainBundle:RoomSeeker')
				->getSimilarAdverts(
					$advertTobeSimilarTo->getBudget(), 
					$advertTobeSimilarTo->getSelfPreference()->getGender(), 
					$advertTobeSimilarTo->getNumberOfSeekers(), 
					$advertTobeSimilarTo->getId(), 
					3
				);
			break;
		}

		return $this->render('PfaMainBundle:Widget:widget.html.twig', array(
			'keyword' => $keyword,
			'type' => $type,
			'adverts' => $adverts
			));
	}
}