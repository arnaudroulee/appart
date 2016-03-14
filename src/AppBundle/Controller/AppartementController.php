<?php

namespace AppBundle\Controller;

use AppBundle\Form\AppartementRechercheType;
use AppBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Appartement;
use AppBundle\Entity\AppartementRecherche;
use AppBundle\Form\AppartementType;

/**
 * Appartement controller.
 *
 * @Route("/locations")
 */
class AppartementController extends Controller
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

        $appartementRecherche = new AppartementRecherche($data);
        $form = $this->createForm('AppBundle\Form\AppartementRechercheType', $appartementRecherche);
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

        $appartements = $this->getDoctrine()->getRepository('AppBundle:Appartement')->findAll();

        return $this->render('appartement/index.html.twig', array(
            'appartements' => $appartements,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Appartement entity.
     *
     * @Route("/new", name="locations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appartement = new Appartement();
        $form = $this->createForm('AppBundle\Form\AppartementType', $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appartement);
            $em->flush();

            return $this->redirectToRoute('locations_show', array('id' => $appartement->getId()));
        }

        return $this->render('appartement/new.html.twig', array(
            'appartement' => $appartement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Appartement entity.
     *
     * @Route("/{id}", name="locations_show")
     * @Method("GET")
     */
    public function showAction(Appartement $appartement)
    {
        $deleteForm = $this->createDeleteForm($appartement);

        return $this->render('appartement/show.html.twig', array(
            'appartement' => $appartement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Appartement entity.
     *
     * @Route("/{id}/edit", name="locations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Appartement $appartement)
    {
        $deleteForm = $this->createDeleteForm($appartement);
        $editForm = $this->createForm('AppBundle\Form\AppartementType', $appartement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appartement);
            $em->flush();

            return $this->redirectToRoute('locations_edit', array('id' => $appartement->getId()));
        }

        return $this->render('appartement/edit.html.twig', array(
            'appartement' => $appartement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Appartement entity.
     *
     * @Route("/{id}", name="locations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Appartement $appartement)
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
     * Creates a form to delete a Appartement entity.
     *
     * @param Appartement $appartement The Appartement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Appartement $appartement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locations_delete', array('id' => $appartement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
