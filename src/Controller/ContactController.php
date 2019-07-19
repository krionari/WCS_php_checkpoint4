<?php
/**
 * Created by PhpStorm.
 * User: Krionari
 * Date: 15/07/2019
 * Time: 19:45
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_index")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->getForm();

        $form->handleRequest($request);
        $informations = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {

            $message = (new \Swift_Message('New message from ' . $informations['name'] . ' , ' . $informations['email']))
                ->setFrom($informations['email'])
                ->setTo('zboubilarge@gmail.com')
                ->setBody($informations['message'])
            ;
            $mailer->send($message);
            // data is an array with "name", "email", and "message" keys
            $this->addFlash(
                'success',
                'Your request will be processed as soon as possible');
            return $this->redirectToRoute('home_index');

        }


        return $this->render('contact/index.html.twig', ['form' => $form->createView()]);
    }
}