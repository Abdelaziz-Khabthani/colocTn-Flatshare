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

class SearchController extends Controller {

	/**
     * @Route("/results/{page}", name="list_search", defaults={"page" = 1}, requirements={"page": "\d*"})
     */
	public function simpleSearchAction(Request $request, $page) {
		$em = $this->getDoctrine()->getManager();
		$code = $request->query->get('code');

		if ($code == null || $code == '') {
			$nbPerPage = 3;
			$searchResult = 0;

			$target = $request->query->get('target');
			$town = $request->query->get('town');
			$gender = $request->query->get('gender');
			$budget = '';
			if ($request->query->get('budget') != null && $request->query->get('budget') != '') {
				$budgets = explode(';', $request->query->get('budget'));
				$budgetMin = $budgets[0];
				$budgetMax= $budgets[1];
			}

			if ($town < 1|| $town >23) {
				if ($town != null  || $town != '')
					throw $this->createNotFoundException("Error");
			}

			if ($gender < 1 || $gender > 2) {
				if ($gender != null  || $gender != '')
					throw $this->createNotFoundException("Error");
			}

			if ((($target == "") || ($target == null)) || (!(($target == 'roomseeker') || ($target == 'collocation') || ($target == 'room') || ($target == 'wholeproperty')))) {
				throw $this->createNotFoundException("Veuillez SVP saisie qu'est ce que vous cherchez.");
			}

			if (($budgetMin < 100 || $budgetMax > 1000)) {
				throw $this->createNotFoundException("Error");
			}

			switch ($target) {
				case 'roomseeker':
				$adverts = $em->getRepository('PfaMainBundle:RoomSeeker')->simpleSearch($town, $gender, $budgetMin, $budgetMax, $page, $nbPerPage);
				break;
				case 'room':
				$adverts = $em->getRepository('PfaMainBundle:Room')->simpleSearch(0, $town, $gender, $budgetMin, $budgetMax, $page, $nbPerPage);
				break;
				case 'collocation':
				$adverts = $em->getRepository('PfaMainBundle:Room')->simpleSearch(1, $town, $gender, $budgetMin, $budgetMax, $page, $nbPerPage);
				break;
				case 'wholeproperty':
				$adverts = $em->getRepository('PfaMainBundle:WholeProperty')->simpleSearch($town, $gender, $budgetMin, $budgetMax, $page, $nbPerPage);
				break;
			}



			if ($adverts == null) {
				$nbPages = 1;
				$searchResult = 0;
			} else {
				$nbPages = ceil(count($adverts)/$nbPerPage);
				$searchResult = count($adverts);
			}

			if (($page > $nbPages)) {
				throw $this->createNotFoundException("The Page ".$page." Does Not Exist.");
			}

			return $this->render('PfaMainBundle:Search:listAdverts.html.twig', array(
				'adverts' => $adverts,
				'target' => $target,
				'nbPages' => $nbPages,
				'page' => $page,
				'searchResult' => $searchResult
				));
		} else {
			if (is_numeric($code)){
				$type = substr($code, -1);
				$id = substr($code, 0, -1);
				switch ($type) {
					case '1':
					$advert = $em->getRepository('PfaMainBundle:WholeProperty')->find($id);
					if ($advert != null) {
						return $this->redirectToRoute('show_whole_property', array('id' => $advert->getId()));
					}
					break;
					case '2':
					$advert = $em->getRepository('PfaMainBundle:Room')->find($id);
					if ($advert != null) {
						return $this->redirectToRoute('show_room', array('id' => $advert->getId()));
					}
					break;
					case '3':
					$advert = $em->getRepository('PfaMainBundle:RoomSeeker')->find($id);
					if ($advert != null) {
						return $this->redirectToRoute('show_room_seeker', array('id' => $advert->getId()));
					}
					break;
					default:
					throw $this->createNotFoundException('Annocne introuvable');
					break;
				}
				throw $this->createNotFoundException('Annocne introuvable');
			} else {
				throw $this->createNotFoundException('Annocne introuvable');
			}
		} 
	}
}