<?php

namespace Faculte\EnseignantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaculteEnseignantBundle:Default:index.html.twig');
    }
}
