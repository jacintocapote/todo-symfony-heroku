<?php

namespace JCapote\ToDoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JcapoteToDoBundle:Default:index.html.twig');
    }
}
