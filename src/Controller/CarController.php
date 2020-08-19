<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use Symfony\Component\HttpFoundation\Request;

class CarController extends AbstractController
{

    /**
     * @Route("/car/add", name="add_car")
     */
    public function addCar(Request $request)
    {
		$car = new car();
		$form = $this->createForm(CarType::class, $car);

	    $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();
            $car = new car();
		    $form = $this->createForm(CarType::class, $car);
            return $this->render('car/add.html.twig', array('form' => $form->createView(), 'alert' => true));
        }
        else {
            return $this->render('car/add.html.twig', array('form' => $form->createView(), 'alert' => false));
        }
    }
}
