<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use AppBundle\Form\EmailType;
use AppBundle\Entity\Conntact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/email")
 */
class EmailController extends Controller
{
    /**
     * @Route("/new/{conntactId}")
     * @Template("AppBundle:Email:new.html.twig")
     */
    public function newAction(Request $request, $conntactId)
    {
        $email = new Email();
        $form = $this->createForm(
            new EmailType(),
            $email,
            [
                'action'=>$this->generateUrl('app_email_create', ['conntactId'=>$conntactId])
            ]
        );
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/create/{conntactId}")
     * @Template("AppBundle:Email:new.html.twig")
     */
    public function createAction(Request $request, $conntactId)
    {
        $email = new Email();
        $form = $this->createForm(new EmailType, $email);
        $form->handleRequest($request);

        $conntact =$this
            ->getDoctrine()
            ->getRepository('AppBundle:Conntact')
            ->find($conntactId);
        if (!$conntact) {
            throw $this->createNotFoundException('conntact not found');
        }

        $email->setConntact($conntact);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('app_conntact_show',
                [
                    'id'=>$conntact->getId()
                ]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/modify/{id}")
     * @Template("AppBundle:Email:new.html.twig")
     */
    public function modifyAction(Request $request, $id)
    {
        $email = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Email')
            ->find($id);
        if (!$email) {
            throw $this->createNotFoundException('Email not found');
        }

        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($request);
        $conntactId = $email->getConntact()->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_conntact_show', [ 'id'=>$conntactId]);
        }
        return ['form' => $form->createView()];

    }

    /**
     * @Route("/delete/{id}")
     * @Template("AppBundle:Conntact:show.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $email = $this->getDoctrine()->getRepository('AppBundle:Email')->find($id);
        if (!$email) {
            throw $this->createNotFoundException('Email not found');
        }
        $conntactId = $email->getConntact()->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($email);
        $em->flush();
        return $this->redirectToRoute('app_conntact_show', [ 'id'=>$conntactId]);


    }

}

