<?php
/**
 * Created by PhpStorm.
 * User: Krionari
 * Date: 15/07/2019
 * Time: 19:45
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CircusController extends AbstractController
{
    /**
     * @Route("/circus", name="circus_index")
     */
    public function index(): Response
    {
        return $this->render('circus/index.html.twig');
    }
}