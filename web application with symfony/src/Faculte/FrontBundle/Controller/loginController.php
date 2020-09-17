<?php

namespace Faculte\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class loginController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaculteFrontBundle:Espenseignant:login.html.twig');
    }
}
