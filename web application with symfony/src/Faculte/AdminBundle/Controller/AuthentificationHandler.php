<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faculte\AdminBundle\Controller;
use Faculte\AdminBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface,
    Symfony\Component\Security\Core\Authentication\Token\TokenInterface;



class AuthentificationHandler  implements  AuthenticationSuccessHandlerInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $referer = $request->headers->get('referer');
        // retrieve user and session id
        /**@var $user User */
        $user = $token->getUser();
        $idU = $user->getId();
        $Roles = $token->getUser()->getRoles();

        if($user->hasRole('ROLE_ADMIN')){
            return new RedirectResponse($this->router->generate('faculte_admin_homepage'));
        }elseif ($user->hasRole('ROLE_ENSEIGNANT')) {
            return new RedirectResponse($this->router->generate('faculte_enseignant_homepage'));
        }
        elseif($user->hasRole('ROLE_ETUDIANT')) {
            return new RedirectResponse($this->router->generate('faculte_etudiant_homepage'));
        }
    }


}

