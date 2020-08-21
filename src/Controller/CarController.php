<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Parking;
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

    /**
     * @Route("/car/link", name="link")
     */
    public function linkParking(Request $request)
    {
        $repositoryCar = $this->getDoctrine()->getRepository(Car::class);
        $repositoryParking = $this->getDoctrine()->getRepository(Parking::class);
        $cars = $repositoryCar->findBy(array('parking' => null));
        $parkings = $repositoryParking->findAll();
        if ($request->isXmlHttpRequest()) {  
            $carName = $_POST['carName'];
            $parkingName = $_POST['parkingName'];
            $car = $repositoryCar->findOneBy(array('name' => $carName));
            if($car !== null){
            $parking = $repositoryParking->findOneBy(array('name' => $parkingName));
            if($parking !== null) {
                $car->setParking($parking);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($car);
                $entityManager->flush();
            } else {
                $car->setParking(null);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($car);
                $entityManager->flush();
            }
        }
        }
        return $this->render('car/link.html.twig', array('cars' => $cars, 'parkings' => $parkings));
    }
}
