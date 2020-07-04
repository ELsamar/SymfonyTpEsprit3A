<?php

namespace Esprit\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EspritEtudiant/Default/index.html.twig');
    }
    public function sayHelloAction()
    {
        return $this->render('@EspritEtudiant/Default/hello.html.twig');
    }
    public function sayHello2Action($className)
    {
        return $this->render('@EspritEtudiant/Default/hello2.html.twig'
            ,array(
                "class"=>$className
            ));
    }
}
