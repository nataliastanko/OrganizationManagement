<?php

namespace Organization\LogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;

/**
 * @Route("/log")
 */
class LogController extends Controller
{

    /**
     * @Route("/", name="log")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // $repo = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');
        $repo = $em->getRepository('GedmoLoggable:LogEntry');

        $logs = $em->getRepository('GedmoLoggable:LogEntry')
            ->findBy([], ['id' => 'desc']);

        // $logs = $repo->findAll();

        return ['logs' => $logs];
    }

    /**
     * Revert logged object to log version
     * @Route("/revert/{id}", name="log_revert")
     * @ParamConverter("log", class="GedmoLoggable:LogEntry")
     */
    public function revertAction(AbstractLogEntry $log)
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('GedmoLoggable:LogEntry');
        $object = $em->find($log->getObjectClass(), $log->getObjectId());

        if (!$object) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $repo->revert($object, $log->getVersion()); // relation would be reverted also
        $em->persist($object);
        $em->flush();

        $em = $this->getDoctrine()->getManager();

        return $this->redirect($this->generateUrl('log'));
    }

    /**
     * Undelete object
     * @Route("/restore/{id}", name="log_restore")
     * @ParamConverter("log", class="GedmoLoggable:LogEntry")
     */
    public function undeleteAction(AbstractLogEntry $log)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');

        $repo = $em->getRepository('GedmoLoggable:LogEntry');
        $object = $em->find($log->getObjectClass(), $log->getObjectId());

        if (!$object) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        if (!$object->getDeletedAt()) {
            throw $this->createNotFoundException('Entity already restored.');
        }

        $object->setDeletedAt(NULL);
        $em->persist($object);
        $em->flush();

        return $this->redirect($this->generateUrl('log'));
    }

}
