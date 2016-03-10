<?php

namespace AppBundle\Controller;

use Acme\DemoBundle\Form\AppartementsRechercheType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Appartements;
use AppBundle\Entity\AppartementsRecherche;
use AppBundle\Form\AppartementsType;

/**
 * Appartements controller.
 *
 * @Route("/locations")
 */
class AppartementsController extends Controller
{
    /**
     * Lists all Appartements entities.
     *
     * @Route("/", name="locations_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $data = $session->get('recherche', array());

        dump($data);

        $appartementsRecherche = new AppartementsRecherche($data);
        $form = $this->createForm('AppBundle\Form\AppartementsRechercheType', $appartementsRecherche);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();



        if ($form->isSubmitted() && $form->isValid()) {
            $rowData = $request->request->get('appartement_recherche');

            if (isset($rowData['reset'])) {
                $session->set('recherche', array());
                return $this->redirectToRoute('locations_index');
            }

            if (isset($rowData['submit'])) {
                $data = $form->getData()->toArray();
                $session->set('recherche', $data);
            }

        }



        $appartements = $em->getRepository('AppBundle:Appartements')->findBy($data);

        return $this->render('appartements/index.html.twig', array(
            'appartements' => $appartements,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Appartements entity.
     *
     * @Route("/new", name="locations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appartement = new Appartements();
        $form = $this->createForm('AppBundle\Form\AppartementsType', $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appartement);
            $em->flush();

            return $this->redirectToRoute('locations_show', array('id' => $appartement->getId()));
        }

        return $this->render('appartements/new.html.twig', array(
            'appartement' => $appartement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Appartements entity.
     *
     * @Route("/{id}", name="locations_show")
     * @Method("GET")
     */
    public function showAction(Appartements $appartement)
    {
        $deleteForm = $this->createDeleteForm($appartement);

        return $this->render('appartements/show.html.twig', array(
            'appartement' => $appartement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Appartements entity.
     *
     * @Route("/{id}/edit", name="locations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Appartements $appartement)
    {
        $deleteForm = $this->createDeleteForm($appartement);
        $editForm = $this->createForm('AppBundle\Form\AppartementsType', $appartement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appartement);
            $em->flush();

            return $this->redirectToRoute('locations_edit', array('id' => $appartement->getId()));
        }

        return $this->render('appartements/edit.html.twig', array(
            'appartement' => $appartement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Appartements entity.
     *
     * @Route("/{id}", name="locations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Appartements $appartement)
    {
        $form = $this->createDeleteForm($appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appartement);
            $em->flush();
        }

        return $this->redirectToRoute('locations_index');
    }

    /**
     * Creates a form to delete a Appartements entity.
     *
     * @param Appartements $appartement The Appartements entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Appartements $appartement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locations_delete', array('id' => $appartement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
