<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FooController extends Controller
{
    /**
     * @Route("/foo")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render(':foo:index.html.twig', array(
            // ...
        ));
    }

}
