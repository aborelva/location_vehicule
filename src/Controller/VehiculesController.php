<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class VehiculesController extends AbstractController
{
    /**
     * @Route("/vehicules", name="app_vehicules")
     */
    public function index(VehiculeRepository $repoVehicule,Request $request, EntityManagerInterface $manager2): Response
    {
        $vehicule = $repoVehicule->findVehiculeOneAgence();
        // dd($vehicule);
        $vehicules = new Vehicule;
        $form2 = $this->createForm(VehiculeType::class, $vehicules);;
        $form2->handleRequest($request); 


        if ($form2->isSubmitted() && $form2->isValid()) {
            $manager2->persist($vehicules);
            $manager2->flush();
            $this->addFlash('success',"Le véhicule "." a bien été ajouté");

            return $this->redirectToRoute("vehicules");

        };



        return $this->render('vehicules/index.html.twig', [
            'controller_name' => 'VehiculesController',
            'vehicule' => $vehicule,
            "formVehicule"=>$form2->CreateView()            
        ]);
    }

    /**
     * @Route("/vehicules/update/{id}", name="app_vehicules_update")
     */
    public function update(Vehicule $vehicule, Request $request, EntityManagerInterface $manager2): Response
    {
        $form2 = $this->createForm(VehiculeType::class, $vehicule);
        $form2->handleRequest($request);

        $idAgence = $vehicule->getIdAgence();         


        if ($form2->isSubmitted() && $form2->isValid()) {
            $manager2->persist($vehicule);
            $manager2->flush();
            $this->addFlash('success',"Le véhicule"." ".$vehicule->getTitre()." "."a bien été modifié");

            return $this->redirectToRoute("vehicules");
        };      

        
        return $this->render('vehicules/update.html.twig', [
            'controller_name' => 'VehiculesController',
            'vehicule' => $vehicule,
            "formVehicule"=>$form2->CreateView()            
        ]);
        
    }    

    /**
     * @Route("/vehicules/delete/{id}", name="app_vehicules_delete")
     */
    public function delete(Vehicule $vehicule, Request $request, EntityManagerInterface $manager2)
    {
        $idVehicule = $vehicule->getId();
        $manager2->remove($vehicule);
        $manager2->flush();

        $this->addFlash('success',"Le véhicule "." ".$vehicule->getTitre()." "." a bien été supprimé");
        return $this->redirectToRoute("vehicules");
        ;
    }

    /**
     * @Route("/vehicules/detail/{id}/", name="app_vehicules_details")
     */
    public function detail(VehiculeRepository $repoVehicule, $id)
    {
                
        

        $vehicules = $repoVehicule->findOnId($id);
        
        return $this->render("vehicules/detail.html.twig", ["vehicules" => $vehicules]);

    
         return $this->redirectToRoute("vehicules");
     

    }

    /**
     * @Route("/vehicules/detail/{id}/{id_agence}", name="app_vehicules_details")
     */
    /**
     * @Route("/vehicules/detail/{id}/{id_agence}", name="app_vehicules_details")
     */
    /**
     * @Route("/vehicules/detail/{id}/{id_agence}", name="app_vehicules_details")
     */
    


}

