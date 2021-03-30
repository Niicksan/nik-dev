<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $password = $this->passwordEncoder
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render("user/register.html.twig",
            array('form'=>$form->createView())
        );
    }

    /**
     * @param Request $request
     *
     * @param $id
     * @param $email
     * @param $fullName
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/profile/edit/{id}", name="user_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, $id)
    {
        $user = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $password = $user->getPassword();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if ($request->getPassword() == $user->getPassword()){
                $user->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->merge($user);
                $em->flush();
            }

            return $this->redirectToRoute('user_profile');
        }

        return $this->render('user/edit.html.twig',
            ['form' => $form->createView(), 'user' => $user]
        );
    }

    /**
     * @Route("/user/myArticles", name="user_articles")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function MyArticles()
    {
        $myArticles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['authorId' => $this->getUser()]);

        return $this->render('user/myArticles.html.twig',
            ['myArticles' => $myArticles]
        );
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/profile", name="user_profile")
     */
    public function profileAction()
    {
        $user = $this->getUser();
        return $this->render("user/profile.html.twig", ['user'=>$user]);
    }
}