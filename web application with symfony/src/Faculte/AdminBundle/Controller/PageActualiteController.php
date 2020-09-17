<?php
namespace Faculte\AdminBundle\Controller;


use Faculte\AdminBundle\Entity\Publier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faculte\AdminBundle\Form\PublierType;
use Symfony\Component\HttpFoundation\Request;



class PageActualiteController extends controller
{
    public function PageActualiteAction()
    {
        return $this->render('FaculteAdminBundle:Publier:PageActualite.html.twig');
    }
}