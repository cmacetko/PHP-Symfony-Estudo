<?php

namespace Biblioteca\BibliotecaBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Exemplo1
{
   
    public function ImprimirResultado($num1, $num2)
    {
		
        return $num1 + $num2;
		
    }
}
