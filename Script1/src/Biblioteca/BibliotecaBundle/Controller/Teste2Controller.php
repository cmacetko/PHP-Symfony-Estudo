<?php

namespace Biblioteca\BibliotecaBundle\Controller;

use Biblioteca\BibliotecaBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Teste2Controller extends Controller
{
    /**
     * @Route("/teste2", name="home")
     */
    public function indexAction(Request $request)
    {

        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            //->setAction($this->generateUrl('home_sucesso'))
            ->setMethod('GET')
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->add('saveAndAdd', 'submit', array('label' => 'Save and Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? 'home'
                : 'home_sucesso';

            return $this->redirectToRoute($nextAction);

        }

        return $this->render('BibliotecaBundle:Default:teste2tpl.html.twig', array(
            'form' => $form->createView(),
        ));


		
    }

    /**
     * @Route("/teste2/success",  name="home_sucesso")
     */
    public function teste2successAction(Request $request)
    {


        return $this->render('BibliotecaBundle:Default:teste2tpl_success.html.twig');



    }

}
