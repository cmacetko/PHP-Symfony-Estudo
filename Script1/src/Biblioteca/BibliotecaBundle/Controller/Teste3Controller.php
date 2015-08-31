<?php

namespace Biblioteca\BibliotecaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class Teste3Controller extends Controller
{
    /**
     * @Route("/teste3", name="home")
     */
    public function indexAction(Request $request)
    {



        $em = $this->getEntityManager();

        $queryBuilder = $em->getRepository('TablelessModelBundle:Post')
            ->createQueryBuilder('p');


        dump($queryBuilder);




        exit();






        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('TablelessModelBundle:Post')->findAllInOrder();
dump($posts);




        exit();





        echo $request->getPathInfo();
        echo "<br>";
        echo $request->getRequestUri();


        exit();
        return new Response('xxxxxxxxxxxxxxxx');






        echo "OK";
        exit();

        $conn = $this->get('database_connection');
        $users = $conn->fetchAll('SELECT * FROM caa_categoria_noticia');

        dump($users);
       echo "OK";
exit();

    }

}
