<?php

namespace Organization\ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Organization\ManagementBundle\Entity\Helper;
use Organization\ManagementBundle\Form\HelperType;

/**
 * Helper controller.
 *
 * @Route("/helper")
 */
class HelperController extends Controller
{

    /**
     * Lists all Helper entities.
     *
     * @Route("/", name="helper")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrganizationManagementBundle:Helper')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Helper entity.
     *
     * @Route("/", name="helper_create")
     * @Method("POST")
     * @Template("OrganizationManagementBundle:Helper:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Helper();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('helper_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Helper entity.
     *
     * @param Helper $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Helper $entity)
    {
        $form = $this->createForm(new HelperType(), $entity, array(
            'action' => $this->generateUrl('helper_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Helper entity.
     *
     * @Route("/new", name="helper_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Helper();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Helper entity.
     *
     * @Route("/{id}", name="helper_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Helper')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Helper entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Helper entity.
     *
     * @Route("/{id}/edit", name="helper_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Helper')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Helper entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Helper entity.
    *
    * @param Helper $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Helper $entity)
    {
        $form = $this->createForm(new HelperType(), $entity, array(
            'action' => $this->generateUrl('helper_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'validation_groups' => array('settings'),
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing Helper entity.
     *
     * @Route("/{id}", name="helper_update")
     * @Method("PUT")
     * @Template("OrganizationManagementBundle:Helper:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Helper')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Helper entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('helper_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Helper entity.
     *
     * @Route("/{id}", name="helper_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrganizationManagementBundle:Helper')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Helper entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('helper'));
    }

    /**
     * Creates a form to delete a Helper entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('helper_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
