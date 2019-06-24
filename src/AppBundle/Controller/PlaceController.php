<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Place;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;

class PlaceController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/places")
     */
    public function getPlacesAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $placeRepository = $em->getRepository('AppBundle:Place');

        $places = $placeRepository->findAll();

        return $places;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/places/{id}")
     */

    public function getPlaceAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $placeRepository = $em->getRepository('AppBundle:Place');

        $place = $placeRepository->find($request->get("id"));

        if (empty($place)){
            return new JsonResponse(["message" => "place not found"], Response::HTTP_NOT_FOUND);
        }

        return $place;
    }
}