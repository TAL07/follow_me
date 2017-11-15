<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FollowMeBundle\Entity\Dating;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Form\Input\Add;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Throwable;



class AddController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function indexAction(Request $request)
    {

        var_dump(
            $this
            ->get("security.authorization_checker")
            ->isGranted("ROLE_SUPER_ADMIN")
        );



        try {      
            $this->get("session")->start();
            $form = $this->createForm(Add::class);
            $form->handleRequest($request);
            $idsession = $this->get("session")->get("id");
            $user = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(User::class)
                ->find($idsession);  
            $dating = $this->get("follow_me.dating");
            
                if ($form->isSubmitted() && $form->isValid()) {
                    $dating->setUser($user);
                    $dating->setDatingTitle($form->getData()["dating_title"]);
                    $dating->setDatingDescription($form->getData()["dating_description"]);
                if ($form->getData()["dating_start"]->getTimestamp() < time())
                {
                    $form->get("dating_start")->addError(new FormError("add.time.start.error"));
                    throw new \Exception;
                }
                    $dating->setDatingStart($form->getData()["dating_start"]->getTimestamp());
                if (($form->getData()["dating_end"]->getTimestamp() ==  -3600)) 
                {
                    $form->getData("dating_end")->addError(new FormError("add.time.end.error"));
                    throw new \Exception;
                }
               
                $dating->setDatingEnd($form->getData()["dating_start"]->getTimestamp() +
                    $form->getData()["dating_end"]->getTimestamp() + 3600);
                $dating->setDatingLinkHref($form->getData()["dating_link_href"]);
                $dating->setDatingLinkTitle($form->getData()["dating_link_title"]);
            
                
                $this->getDoctrine()->getManager()->persist($dating);
                $this->getDoctrine()->getManager()->flush();
                    
                 throw new \RuntimeException;
                }
              
            } catch (\RuntimeException $e) {
                return $this->redirectToRoute("dating");
            } catch (\Exception $e) {
            } catch (\Throwable $e) { 
                 
                 $form->addError(new FormError("add.error"));
            }
            return $this->render('FollowMeBundle:Add:index.html.twig',
                [
                    "form" => $form->createView()
                ]);
    }
}
