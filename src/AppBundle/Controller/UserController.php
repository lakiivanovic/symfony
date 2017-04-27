<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserControler extends Controler {
    
    public function listUsers(){
        
   $users = $this->getDoctrine()
        ->getRepository('AppBundle:Users')
        ->findAll();

    if (!$users) {
        throw $this->createNotFoundException(
            'No users found'
        );
       
    }
    
     return $this->render('user/list.html.twig', [
                   'users' => $users
        ]);
    }
    
    public function createUser (Request $request){
        
        $user = new User();


        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
                    'form' => $form->createView()
        ]);
        
    }
    
    

    
    
    
    }