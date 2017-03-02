<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conntact;
use AppBundle\Form\ConntactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/conntact")
 */
class ConntactController extends Controller
{
    /**
     * @Route("/new")
     * @Template("AppBundle:Conntact:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $conntact = new Conntact();

        $form = $this->createForm(
            new ConntactType(),
            $conntact,
            [
                'action' => $this->generateUrl('app_conntact_create')
            ]
        );

        return ['form' => $form->createView()];

    }

    /**
     * @Route("/create")
     * @Template("AppBundle:Conntact:new.html.twig")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $conntact = new Conntact();

        $form = $this->createForm(new ConntactType(), $conntact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($conntact);
            $em->flush();

            return $this->redirectToRoute(
                'app_conntact_show',
                [
                    'id' => $conntact->getId()
                ]
            );
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/modify/{id}")
     * @Template("AppBundle:Conntact:new.html.twig")
     */
    public function modifyAction(Request $request,$id)
    {
        $conntact = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Conntact')
            ->find($id);
        if (!$conntact) {
            throw $this->createNotFoundException('Conntact not found');
        }

        $form = $this->createForm(new ConntactType(), $conntact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->flush();

            return $this->redirectToRoute(
                'app_conntact_show',
                [
                    'id' => $conntact->getId()
                ]
            );
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/showAll")
     * @Template("AppBundle:Conntact:showAll.html.twig")
     */
    public function showAll()
    {
        $conntacts = $this->getDoctrine()->getRepository('AppBundle:Conntact')->findAllASC();
        if (!$conntacts) {
            throw $this->createNotFoundException('Conntacts not found');
        }
        return ['conntacts' => $conntacts];
    }

    /**
     * @Route("/show/{id}")
     * @Template("AppBundle:Conntact:show.html.twig")
     */
    public function show(Request $request,$id)
    {
        $conntact =  $this->getDoctrine()->getRepository('AppBundle:Conntact')->find($id);
        if (!$conntact) {
            throw $this->createNotFoundException('Conntact not found');
        }
        return ['conntact' => $conntact];
    }

    /**
     * @Route("/delete/{id}")
     */
    public function delete($id)
    {
        $conntact =  $this->getDoctrine()->getRepository('AppBundle:Conntact')->find($id);
        if (!$conntact) {
            throw $this->createNotFoundException('Conntact not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($conntact);
        $em->flush();
        return $this->redirectToRoute('app_conntact_showall');
    }
}
