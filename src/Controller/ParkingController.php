<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Parking;
use App\Form\ParkingType;
use App\Dto\ParkingDto;
use App\DataTransformer\ParkingDtoDataTransformer;
use Symfony\Component\HttpFoundation\Request;

class ParkingController extends AbstractController
{
    /**
     * @Route("/parking/add", name="add_parking")
     */
    public function addParking(Request $request)
    {
        $parkingDto = new ParkingDto();
		$form = $this->createForm(ParkingType::class, $parkingDto);

	    $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $dataTransformer = new ParkingDtoDataTransformer();
            $parking = $dataTransformer->transform($parkingDto, 'Parking', []);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parking);
            $entityManager->flush();
            $parkingDto = new ParkingDto();
		    $form = $this->createForm(ParkingType::class, $parkingDto);
            return $this->render('parking/add.html.twig', array('form' => $form->createView(), 'alert' => true));
        }
        else {
            return $this->render('parking/add.html.twig', array('form' => $form->createView(), 'alert' => false));
        }
    }
}
