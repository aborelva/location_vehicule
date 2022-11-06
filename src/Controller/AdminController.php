<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
    * @Route("admin/users", name="admin_users")
    */
    public function usersList(UserRepository $user)
    {
        return $this->render('admin/user.html.twig', [
        'user' => $user->findAll(),
        ]);
    }

    /**
    * @Route("/users/update/{id}", name="user_update")
    */
    public function updateUser(User $user, Request $request, EntityManagerInterface $manager): Response
    {
        $form=$this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $manager->persist($user);
            $manager->flush();
           
            $this->addFlash('success',"L'utilisateur "." ".$user->getEmail()." "." a bien été modifiée");

            return $this->redirectToRoute("admin_users", ['id' => $user->getId()]);

            return $this->redirectToRoute("admin_users");
         }
        
         return $this->render('admin/update.html.twig', [
            'controller_name' => 'AdminController',
            'formUser' => $form->createView(),
            'user' => $user
    ]);
    
    
        }

    
}
