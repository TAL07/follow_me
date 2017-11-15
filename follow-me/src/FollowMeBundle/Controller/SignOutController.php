<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;

class SignOutController extends Controller
{
    /**
    * @Route("/main", name="signout")
    */
    public function indexAction()
    {
        try{
            if ( $this->get("session")->start() && $this->get("session")->get("id")) {
                $this->get("session")->invalidate();
            throw new \RuntimeException;
            }                        
        } catch (\RuntimeException $e) {
            return $this->redirectToRoute("main");
        } catch (\Throwable $e) {
            $form->addError(new FormError("vous êtes déjà déconnecté!!"));
                        
        }
        return $this->render('FollowMeBundle:SignOutController:index.html.twig', array(
            // ...
        ));
    }
}
