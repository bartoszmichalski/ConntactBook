<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Phone;
use AppBundle\Form\PhoneType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/phone")
 */
class PhoneController extends Controller
{
    /**
     * @Route("/new/{conntactId}")
     * @Template("AppBundle:Phone:new.html.twig")
     */
    public function newAction(Request $request, $conntactId)
    {
        $phone = new Phone();
        $form = $this->createForm(
            new PhoneType(),
            $phone,
            [
            'action'=>$this->generateUrl('app_phone_create', ['conntactId'=>$conntactId])
            ]
        );
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/create/{conntactId}")
     * @Template("AppBundle:Phone:new.html.twig")
     */
    public function createAction(Request $request, $conntactId)
    {
        $phone = new Phone();
        $form = $this->createForm(new PhoneType, $phone);
        $form->handleRequest($request);
        $conntact =$this
            ->getDoctrine()
            ->getRepository('AppBundle:Conntact')
            ->find($conntactId);
        if (!$conntact) {
            throw $this->createNotFoundException('conntact not found');
        }

        $phone->setConntact($conntact);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
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
     * @Template("AppBundle:Phone:new.html.twig")
     */
    public function modifyAction(Request $request, $id)
    {
        $phone = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Phone')
            ->find($id);
        if (!$phone) {
            throw $this->createNotFoundException('Phone not found');
        }

        $form = $this->createForm(new PhoneType(), $phone);
        $form->handleRequest($request);
        $conntactId = $phone->getConntact()->getId();
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
        $phone = $this->getDoctrine()->getRepository('AppBundle:Phone')->find($id);
        if (!$phone) {
            throw $this->createNotFoundException('Phone not found');
        }
        $conntactId = $phone->getConntact()->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($phone);
        $em->flush();
        return $this->redirectToRoute('app_conntact_show', [ 'id'=>$conntactId]);
    }
}
