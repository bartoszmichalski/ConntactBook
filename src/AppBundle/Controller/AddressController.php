<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/address")
 */
class AddressController extends Controller
{
    /**
     * @Route("/new/{conntactId}")
     * @Template("AppBundle:Address:new.html.twig")
     */
    public function newAction(Request $request, $conntactId)
    {
        $address = new Address();
        $form = $this->createForm(
            new AddressType(),
            $address,
            [
                'action' => $this->generateUrl('app_address_create', ['conntactId'=>$conntactId])
            ]
        );

        return ['form' => $form->createView()];

    }

    /**
     * @Route("/create/{conntactId}")
     * @Method("POST")
     */
    public function createAction(Request $request, $conntactId)
    {
        $address = new Address();

        $form = $this->createForm(new AddressType(), $address);

        $form->handleRequest($request);

        $conntact = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Conntact')
            ->find($conntactId);
        if (!$conntact) {
            throw $this->createNotFoundException('conntact not found');
        }

        $address->setConntact($conntact);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($address);
            $em->flush();
            return $this->redirectToRoute('app_conntact_show',
                [
                    'id' => $conntact->getId()
                ]);
//
//            return $this->redirectToRoute(
//                'app_address_show',
//                [
//                    'id' => $address->getId()
//                ]
//            );
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/modify/{id}")
     * @Template("AppBundle:Address:new.html.twig")
     */
    public function modifyAction(Request $request,$id)
    {
        $address = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Address')
            ->find($id);
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }

        $form = $this->createForm(new AddressType(), $address);

        $form->handleRequest($request);
        $conntact = $address->getConntact()->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->flush();
            return $this->redirectToRoute('app_conntact_show', [ 'id'=>$conntact]);
        }
        return ['form' => $form->createView()];

    }


    /**
     * @Route("/show/{id}")
     * @Template("AppBundle:Address:show.html.twig")
     */
    public function show(Request $request,$id)
    {
        $address =  $this->getDoctrine()->getRepository('AppBundle:Address')->find($id);
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }
        return ['address' => $address];
    }

    /**
     * @Route("/delete/{id}")
     */
    public function delete($id)
    {
        $address =  $this->getDoctrine()->getRepository('AppBundle:Address')->find($id);
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }
        $conntact = $address->getConntact()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();
        return $this->redirectToRoute('app_conntact_show', [ 'id'=>$conntact]);
    }
}
