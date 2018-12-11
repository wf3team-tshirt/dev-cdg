<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Service\UserService;

use App\Form\LoginType;
use App\Form\RegisterType;

class UserController extends AbstractController
{
    /**
     * @Route("/user/login", name="login")
     */
    public function login(Request $request, UserService $userService, AuthenticationUtils $authenticationUtils )
    {
        $user = new User();

        $form = $this->createForm( LoginType::class, $user );

        // Contrôle les @Assert dans l'entité
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            // Service

            if ( $userService->isConnected( $user ) ) {
                return $this->redirectToRoute('home');
            } else {
                return $this->redirectToRoute('login');
            };
        }

        return $this->render('user/login.html.twig', [
            'title' => 'Se connecter',
            'lasUsername' => $authenticationUtils->getLastUsername(),
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/user/register", name="register")
     */
    public function register(Request $request, UserService $userService /*, UserPasswordEncoderInterface $encoder*/ )
    {

        $user = new User();

        $form = $this->createForm( RegisterType::class, $user );

        // Contrôle les @Assert dans l'entité
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $user->setRoles( ['ROLE_USER'] );

            // Service
            $userService->add( $user );

            return $this->redirectToRoute('account', [ 'id' => $user->getId() ]);
        }

        return $this->render('user/register.html.twig', [
            'title' => 'S\'inscrire',
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/user/account/{id}", name="account")
     */
    public function account(Request $request, UserService $userService, string $id )
    {
        return $this->render('user/account.html.twig', [
            'title' => 'Votre compte',
            'id' => $id,
            'user' => $userService->getOneId( $id ),
        ]);
    }

    /**
     * @Route("/adm/logout", name="logout")
     */
    public function logout() {}

}