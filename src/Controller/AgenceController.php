<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceController extends AbstractController
{
    /**
     * @Route("/agence", name="app_agence")
     */
    public function index(AgenceRepository $repoAgence, Request $request, EntityManagerInterface $manager): Response
    {
        $agence = $repoAgence->findAll();
        $agences = New Agence;
        $form = $this->createForm(AgenceType::class, $agences);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($request);
            $manager->persist($agences);
            $manager->flush();
            $this->addFlash('success',"L'agence"." ".$agences->getTitre()." "."a bien été ajouté");

            return $this->redirectToRoute("agence");
        }

        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
            'agence' => $agence,
            "formAgence"=>$form->CreateView() 
        ]);
    }

    /**
     * @Route("/agence/update/{id}", name="agence_update")
     */
    public function update(Agence $agence, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $manager->persist($agence);
            $manager->flush();
           
            $this->addFlash('success',"L'agence "." ".$agence->getTitre()." "." a bien été modifiée");

            return $this->redirectToRoute("agence", ['id' => $agence->getId()]);

            return $this->redirectToRoute("agence");
         }

        return $this->render('agence/update.html.twig', [
            'controller_name' => 'Page Update',
            'formAgence' => $form->createView(),
            'agence' => $agence
    ]);
    }

     /**
     * @Route("/agence/delete/{id}", name="agence_delete")
     */
    public function delete(Agence $agence, EntityManagerInterface $manager)
    {
        $idAgence = $agence->getId();

        $manager->remove($agence);
        $manager->flush();

        $this->addFlash('success',"L'agence "." ".$agence->getTitre()." "." a bien été supprimée");


        return $this->redirectToRoute("agence");
     


    }

      /**
     * @Route("/agence/detail/{id}", name="agence_detail")
     */
    public function detail(AgenceRepository $repoAgence, $id)
    {
        $agences = $repoAgence->find($id);

        return $this->render("agence/detail.html.twig", ["agences" => $agences]);

        return $this->redirectToRoute("agence");
     


    }
}
