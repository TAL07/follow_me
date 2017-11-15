<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FollowMeBundle\Form\Input\SignIn;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use FollowMeBundle\Entity\User;
use Throwable;


class SignInController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
    public function indexAction (Request $request)
    {
            try {   
                    $this->get("session")->start();
                    // if ( $this->get("session")->get("id")) {
                    // throw new \RuntimeException;
                    // }

                    $form = $this->createForm(SignIn::class);
                    $form->handleRequest($request);
                    if (!$form->isSubmitted() || !$form->isValid()) {
                            throw new \InvalidArgumentException;
                        }
                    if (($user = $this->getDoctrine()
                                       ->getRepository(User::class)
                                       ->findOneBy([
                                            "userMail" => $form->getData()["user_mail"]
                    ]))) {
                        if (!password_verify(
                                $form->getData()["user_pswd"], //=$pswd
                                $user->getUserPswd()          //=$hash
                            )) {
                         
                            throw new \Exception;
                        }
                    
                    // creation session
                        $this->get("session")->set("id", $user->getUserId());
                        throw new \RuntimeException;
                        }
                        throw new \Throwable;
                } catch (\InvalidArgumentException $e) {
                } catch (\RuntimeException $e) {
                    return $this->redirectToRoute("main");
                } catch (\Throwable $e) {
                    dump($e);
                    $form->addError(new FormError("sign.error"));
                                
                }
                return $this->render('FollowMeBundle:SignIn:index.html.twig',
                [
                        "form" => $form->createView()     
                ]
    
                );
        
    }

}
