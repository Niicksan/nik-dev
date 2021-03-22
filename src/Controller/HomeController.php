<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('home/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @Route("/contacts", name="home_contacts")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() )
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('home/contacts.html.twig',
            array('contactForm'=>$form->createView())
        );
    }
}