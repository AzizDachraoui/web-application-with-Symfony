<?php

namespace Faculte\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class forgottonpasswordController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaculteFrontBundle:Espenseignant:forgottonpassword.html.twig');
    }
}
