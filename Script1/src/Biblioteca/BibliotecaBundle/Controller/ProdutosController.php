<?php

namespace Biblioteca\BibliotecaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biblioteca\BibliotecaBundle\Entity\Produtos;
use Biblioteca\BibliotecaBundle\Form\ProdutosType;

/**
 * Produtos controller.
 *
 * @Route("/produtos")
 */
class ProdutosController extends Controller
{

    /**
     * Lists all Produtos entities.
     *
     * @Route("/", name="produtos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BibliotecaBundle:Produtos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Produtos entity.
     *
     * @Route("/", name="produtos_create")
     * @Method("POST")
     * @Template("BibliotecaBundle:Produtos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Produtos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('produtos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Produtos entity.
     *
     * @param Produtos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Produtos $entity)
    {
        $form = $this->createForm(new ProdutosType(), $entity, array(
            'action' => $this->generateUrl('produtos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Produtos entity.
     *
     * @Route("/new", name="produtos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Produtos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Produtos entity.
     *
     * @Route("/{id}", name="produtos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BibliotecaBundle:Produtos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produtos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Produtos entity.
     *
     * @Route("/{id}/edit", name="produtos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BibliotecaBundle:Produtos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produtos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Produtos entity.
    *
    * @param Produtos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Produtos $entity)
    {
        $form = $this->createForm(new ProdutosType(), $entity, array(
            'action' => $this->generateUrl('produtos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Produtos entity.
     *
     * @Route("/{id}", name="produtos_update")
     * @Method("PUT")
     * @Template("BibliotecaBundle:Produtos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BibliotecaBundle:Produtos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produtos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('produtos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Produtos entity.
     *
     * @Route("/{id}", name="produtos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BibliotecaBundle:Produtos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Produtos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('produtos'));
    }

    /**
     * Creates a form to delete a Produtos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
