<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class UserService {

    // Object Manager global
    private $om;

    public function __construct( ObjectManager $om ) {
        $this->om = $om;
    }

    // public function add( $event ) {
    //     $repo = $this->om->getRepository( User::class );
    //     $iduser = $this->om->find( User::class, 1 );
    //     $event->setUser( $iduser );
    //     $idaddress = $this->om->find( TAddress::class, 1 );
    //     $event->setTAddress( $idaddress );
    //     $this->setupMedia( $event );
    //     $this->om->persist( $event );
    //     $this->om->flush();
    // }

    // private function setupMedia( $event ) {
    //     // Si URL
    //     if ( !empty( $event->getPosterurl() ) )
    //     {
    //         return $event->setPoster( $event->getPosterurl() );
    //     }
    //     // Si UPLOAD
    //     $file = $event->getPosterfile();
    //     // Génére un nom de fichier aléatoire pour éviter les conflits de nom
    //     // A ne pas utiliser dans un contexte de sécurité
    //     $filename = md5( uniqid() ) . '.' . $file->guessExtension();
    //     // On déplace le fichier dans /public/files
    //     $file->move( './files', $filename );
    //     return $event->setPoster( $filename );
    // }

    public function add( $user, UserPasswordEncoderInterface $passwordEncoder ) {
        // On définit le rôle
        $user->addRole( ['ROLE_BUYER'] );

        // On crypte le mot de passe
        $password = $passwordEncoder->encodePassword( $user, $user->getPlainPassword() );
        $user->setPassword( $password );

        // On active par défaut
        $user->setActive( true );

        $repo = $this->om->getRepository( User::class );
        $this->om->persist( $user );
        $this->om->flush();
    }
    
    public function getAll() {
        $repo = $this->om->getRepository( User::class );
        return $repo->findAll();
    }

    public function getOneId( $id ) {
        $repo = $this->om->getRepository( User::class );
        return $repo->find( $id );
    }

    public function isUsernameExist( $username ) {
        $repo = $this->om->getRepository( User::class );
        return ( !empty( $repo->findBy( array( 'username' => $username ) )[0]->getUsername() ) );
    }

    public function getPassword( $username ) {
        $repo = $this->om->getRepository( User::class );
        return $repo->findBy( array( 'username' => $username ) )[0]->getPassword();
    }

    public function isConnected( $user ) {
        $user_password = $user->getPassword();
        $bdd_password = $this->getPassword( $user->getUsername() );
        return ( password_verify( $user_password, $bdd_password ) );
    }

}