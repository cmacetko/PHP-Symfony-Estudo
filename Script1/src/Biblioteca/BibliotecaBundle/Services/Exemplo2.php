<?php

namespace Biblioteca\BibliotecaBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class Exemplo2
{
   
	private $session;
	
	public function __construct(Session $session)
	{
		
		$this->session		= $session;
		
	}
	
    public function exemplo2($data)
    {
		
		$this->session->set('testeService', $data);
		
    }
}
