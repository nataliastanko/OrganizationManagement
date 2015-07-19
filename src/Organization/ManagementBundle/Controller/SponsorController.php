<?php

namespace Organization\ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Organization\ManagementBundle\Entity\Sponsor;
use Organization\ManagementBundle\Form\SponsorType;

/**
 * Sponsor controller.
 *
 * @Route("/sponsor")
 */
class SponsorController extends Controller
{

    /**
     * Lists all Sponsor entities.
     *
     * @Route("/", name="sponsor")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrganizationManagementBundle:Sponsor')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sponsor entity.
     *
     * @Route("/", name="sponsor_create")
     * @Method("POST")
     * @Template("OrganizationManagementBundle:Sponsor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sponsor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sponsor_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sponsor entity.
     *
     * @param Sponsor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sponsor $entity)
    {
        $form = $this->createForm(new SponsorType(), $entity, array(
            'action' => $this->generateUrl('sponsor_create'),
            'method' => 'POST',
            // 'validation_groups' => array(''),
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sponsor entity.
     *
     * @Route("/new", name="sponsor_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sponsor();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sponsor entity.
     *
     * @Route("/{id}", name="sponsor_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sponsor entity.
     *
     * @Route("/{id}/edit", name="sponsor_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
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
    * Creates a form to edit a Sponsor entity.
    *
    * @param Sponsor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sponsor $entity)
    {
        $form = $this->createForm(new SponsorType(), $entity, array(
            'action' => $this->generateUrl('sponsor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing Sponsor entity.
     *
     * @Route("/{id}", name="sponsor_update")
     * @Method("PUT")
     * @Template("OrganizationManagementBundle:Sponsor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrganizationManagementBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sponsor_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sponsor entity.
     *
     * @Route("/{id}", name="sponsor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrganizationManagementBundle:Sponsor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sponsor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sponsor'));
    }

    /**
     * Creates a form to delete a Sponsor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sponsor_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
