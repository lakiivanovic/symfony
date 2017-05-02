<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class RegisterController extends Controller {

    public function registerAction(Request $request) {

        $user = new User();


        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            $this->redirectToRoute('login');
        }

        return $this->render('registration/register.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
