<?php

namespace Organization\ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Organization\ManagementBundle\Entity\Meeting;
use Organization\ManagementBundle\Form\MeetingType;

/**
 * Meeting controller.
 *
 * @Route("/meeting")
 */
class MeetingController extends Controller
{

    /**
     * Lists all Meeting entities.
     *
     * @Route("/", name="meeting")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrganizationManagementBundle:Meeting')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Meeting entity.
     *
     * @Route("/", name="meeting_create")
     * @Method("POST")
     * @Template("OrganizationManagementBundle:Meeting:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_create'),
            'method' => 'POST',
            'validation_groups' => array('settings'),
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Meeting entity.
     *
     * @Route("/new", name="meeting_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Meeting();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Meeting entity.
     *
     * @Route("/{id}", name="meeting_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Meeting entity.
     *
     * @Route("/{id}/edit", name="meeting_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
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
    * Creates a form to edit a Meeting entity.
    *
    * @param Meeting $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'validation_groups' => array('settings'),
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Meeting entity.
     *
     * @Route("/{id}", name="meeting_update")
     * @Method("PUT")
     * @Template("OrganizationManagementBundle:Meeting:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Meeting entity.
     *
     * @Route("/{id}", name="meeting_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrganizationManagementBundle:Meeting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meeting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('meeting'));
    }

    /**
     * Creates a form to delete a Meeting entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meeting_delete', array('id' => $id)))
            ->setMethod('DELETE')
             ->add('submit', 'submit',
                [
                    'label' => 'button.delete',
                    'attr' => ['class' => 'btn btn-default']
                ]
            )
            ->getForm()
        ;
    }
}
