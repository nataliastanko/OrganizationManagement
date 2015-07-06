<?php

namespace Management\EnrollmentBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Management\EnrollmentBundle\Entity\Answer;

/**
 * Answer controller.
 *
 * @Route("/answer")
 */
class AnswerController extends Controller
{

    /**
     * Lists all Answer entities.
     *
     * @Route("/", name="answer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagementEnrollmentBundle:Answer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Answer entity.
     *
     * @Route("/{id}", name="answer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagementEnrollmentBundle:Answer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Answer entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
