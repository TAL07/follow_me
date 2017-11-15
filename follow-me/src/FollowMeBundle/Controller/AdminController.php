<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\Criteria;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Entity\Dating;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {

        try {
            $this->get("session")->start();
            $page =
                (int) $request->get("page") > 1
                ? (int) $request->get("page")
                : 1;
            $maxResults = 5;
            
        
            if(!$this->get("session")->get("id")) {
                return $this->redirectionToRoute("main");
            }

            $criteria = new Criteria;
            $criteria
            ->setMaxResults($maxResults);
  

        if ($page) {
                $criteria->setFirstResult (
                    ($page -1) * $maxResults
                );
            }
            $users = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository(User::class)
                // ->findAll();
                    ->matching($criteria);
        } catch (Exception $e) {

        }
        $id = (int) $request->get("e"); 
        return $this->render('FollowMeBundle:Admin:index.html.twig',
        [
            "id" => $id,
            "users" => $users,
            "page" => $page,
            "max" => $maxResults
        ]);
    }

    /**
     * @Route("/admin/user/{id}", name="admin_user")
     */
    
    public function removeUserAction($id)
    {
        $url = $this->generateUrl("admin");
        try {
            if(!($user = $this->getDoctrine()->getManager()->find(User::class, $id)))
            {
                return $this->redirect($url . "?e=");
            }
        // si pas de user:redirect
            if(($dating = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository(Dating::class)
                    ->findBy(["user" => $user]))
            && 0 !== count($dating)) {
            // si dating: boucle et remove et flush
            foreach ($dating as $date) {
                $this->getDoctrine()->getManager()->remove($date);
            }        
            $this->getDoctrine()->getManager()->flush();
            }
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect($url . "?e=" . $id);
    } catch (\Throwable $e) {

    } 
  //redirect      
        
    }

}
