<?php

namespace Management\EnrollmentBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Management\EnrollmentBundle\Entity\Question;

/**
 * Question controller.
 *
 * @Route("/question")
 */
class QuestionController extends Controller
{

    /**
     * Lists all Question entities.
     *
     * @Route("/", name="question")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagementEnrollmentBundle:Question')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Question entity.
     *
     * @Route("/{id}", name="question_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagementEnrollmentBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
