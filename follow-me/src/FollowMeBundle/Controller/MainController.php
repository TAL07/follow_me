<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction()
    {
        return $this->render('FollowMeBundle:Main:index.html.twig', 
        [
            
        ]);
    }
    
    /**
     * @Route("/banner", name="banner")
     */
    
    public function bannerAction()
    {
        return $this->render('FollowMeBundle:Main:banner.html.twig');      
    }
    
    /**
     * @Route(
     *      "/foo/{identifiant}", 
     *       name="foo",
     *       defaults={"identifiant": "truc"},
     *       requirements={
     *       "identifiant": "a|b"
     *       }
     * )
     */
    public function foo($identifiant)
    {

        die($identifiant);
    }

}
