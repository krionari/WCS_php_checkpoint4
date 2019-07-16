<?php
/**
 * Created by PhpStorm.
 * User: Krionari
 * Date: 15/07/2019
 * Time: 19:45
 */

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArtistController
 * @package App\Controller
 * @Route("/artist", name="artist_")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(UserRepository $userRepository): Response
    {

        $artists = $userRepository->findBy(['role' => 'artist']);

        return $this->render('user/index.html.twig', ['artists' => $artists]);
    }
}