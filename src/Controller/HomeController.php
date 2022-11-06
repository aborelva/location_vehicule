<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function home(VehiculeRepository $repoVehicule, Request $request): Response
    {
        $vehicule = $repoVehicule->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'vehicule' => $vehicule
                        
        ]);
        
    
     
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index(VehiculeRepository $repoVehicule, Request $request): Response
    {
        return $this->redirectToRoute('home');
        
    }


}
