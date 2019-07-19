<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Form\TourType;
use App\Repository\TourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tour")
 */
class TourController extends AbstractController
{
    /**
     * @Route("/", name="tour_index", methods={"GET"})
     */
    public function index(TourRepository $tourRepository): Response
    {
        return $this->render('tour/index.html.twig', [
            'tours' => $tourRepository->findBy([], ['date' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="tour_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tour = new Tour();
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tour);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your tour has been well created');

            return $this->redirectToRoute('tour_index');
        }

        return $this->render('tour/new.html.twig', [
            'tour' => $tour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_show", methods={"GET"})
     */
    public function show(Tour $tour): Response
    {
        return $this->render('tour/show.html.twig', [
            'tour' => $tour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tour_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tour $tour): Response
    {
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Modification well taken into account');

            return $this->redirectToRoute('tour_index');
        }

        return $this->render('tour/edit.html.twig', [
            'tour' => $tour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tour $tour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tour);
            $entityManager->flush();
        }
        $this->addFlash(
            'danger',
            'Tour deleted');
        return $this->redirectToRoute('tour_index');
    }
}
