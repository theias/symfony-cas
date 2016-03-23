<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FooController extends Controller
{
    /**
     * @Route("/foo")
     */
    public function indexAction()
    {
        return $this->render('@App/Foo/index.html.twig', array(
            // ...
        ));
    }

}
