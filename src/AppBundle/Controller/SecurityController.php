<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SecurityController extends Controller
{
    /**
     * @Route("/login/error")
     * @Method("GET")
     */
    public function errorAction()
    {
        return $this->render(':security:error.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/login/check")
     * @Method("GET")
     */
    public function checkAction()
    {
        return $this->redirectToRoute('homepage');
    }

}
