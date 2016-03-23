<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login/error")
     */
    public function errorAction()
    {
        return $this->render('AppBundle:Security:error.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/login/check")
     */
    public function checkAction()
    {
        return $this->redirectToRoute('homepage');
    }

}
