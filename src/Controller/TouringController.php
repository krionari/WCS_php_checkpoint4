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
 * @Route("/touring")
 */
class TouringController extends AbstractController
{
    /**
     * @Route("/", name="touring_index", methods={"GET"})
     */
    public function index(TourRepository $tourRepository): Response
    {
        return $this->render('tour/index.html.twig', [
            'tours' => $tourRepository->findBy([], ['date' => 'ASC']),
        ]);
    }
}
