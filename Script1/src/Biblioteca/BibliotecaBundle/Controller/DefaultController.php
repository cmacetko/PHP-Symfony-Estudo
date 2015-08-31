<?php

namespace Biblioteca\BibliotecaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", defaults={"name" = "fwwf"}, name="hello")
     */
    public function indexAction($name)
    {

		dump($this->get('Exemplo1')->ImprimirResultado(2, 4));
		
		$this->get('Exemplo2')->exemplo2('salvo na seção');
		dump($this->get('session')->get('testeService'));


		dump($this->get('Exemplo3')->teste1());
		
        return $this->render('BibliotecaBundle:Default:index.html.twig', array('name' => $name, 'title' => 'fewui9fwij'));
		
    }
}
