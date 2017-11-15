<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Entity\Dating;
//use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\Criteria;
use Throwable;


class DatingController extends Controller
{
    /**
     * @Route("/dating", name="dating")
     */
    public function indexAction(Request $request)
    {
        try {
            $this->get("session")->start();
            $page =
                (int) $request->get("page") > 1
                ? (int) $request->get("page")
                : 1;
            $maxResults = 3;
            
           
            if(!$this->get("session")->get("id")) {
                return $this->redirectionToRoute("main");
            }

            $criteria = new Criteria;
            $criteria
            ->where($criteria->expr()->gt("datingEnd", time()))
            ->setMaxResults($maxResults)
           ->orderBy(["datingEnd" => Criteria::ASC]);
           if ($page) {
                $criteria->setFirstResult (
                    ($page -1) * $maxResults
                );
            }
            $dating = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository(Dating::class)
                   // ->findAll();
                    ->matching($criteria);
         
                    if (!$dating[0] && $page > 1) {
                     return $this->redirectionToRoute("dating");
                
                }
                   // ->setFirstResult (2)  //(decalage de 2 demandé on ne veut pas les 2 1er resultats)
                } catch ( Exception $e) {
                    
                }
                 return $this->render('FollowMeBundle:Dating:index.html.twig',
                 [
                     "dating" => $dating,
                     "page" => $page,
                     "max" => $maxResults
                 ]);
       
        

        
       
   }
    /**
     * @Route("/modified", name="modified")
     */

//     public function modified(Request $request)
//     {
//         $clientGMT = $request->headers->get("if-modified-since");
//         $gmt = gmdate('D, d M Y H:i:s T', time());
//         // $date = new \DateTime($gmt);
//         if ($clientGMT              //diff entre dern modif et now si inf a 5sec on renvoie un 304
//           && time() - (new \DateTime($clientGMT))->getTimeStamp() < 5) {
//             $response = new Response();
//             $response->setStatusCode(304);
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//             $response->setLastModified(new \DateTime());
//         }

//         $response->setPublic();
//         return $response;
//    }

    /**
     * @Route("/psr6", name="psr6")
     */


    // public function indexAction()
    // {
        
    //     $pool = new FilesystemAdapter(
    //         "", 
    //         0,
    //         __DIR__ . "/../../../var/cache/pools");
        
    //     $item = $pool->getItem('followme.users.custom'); 
    //     $item->expiresAfter(3);
    //     if(!$item->isHit()) {
    //         var_dump("REFRESHHH");
    //         $users = $this
    //         ->getDoctrine()
    //         ->getManager()
    //         ->getRepository(User::class)
    //         ->findAll();
    //         $item->set($users);
    //         $pool->save($item);

    //     }
    //     $users = $item->get();
    //     var_dump($users);

    //     // $cachedCategories = $this->get('cache.app')->getItem('categories');
    //     // if (!$cachedCategories->isHit()) {
    //     //     $categories = ... // fetch categories from the database
    //     //     $cachedCategories->set($categories);
    //     //     $this->get('cache.app')->save($cachedCategories);
    //     // } else {
    //     //     $categories = $cachedCategories->get();
    //     // }
    //     return $this->render('FollowMeBundle:Dating:index.html.twig',
    //     [
    //        // "form" => $form->createView() 
    //     ]
    //     );
    // }



//     /**
//      * @Route("/etag", name="etag")
//      */

//     public function etag(Request $request)
//     {
//         $Etag = md5($request->getRequestUri());

//         var_dump($Etag);
//         var_dump(current($request->getETags()));
//         //if-not-match === etag alors response vide
//         if("\"" . $Etag . "\""  === current($request->getETags())) {
//             $response = new Response();
//             $response->setStatusCode(304);
//         // sinon response avec un rendu    
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//         }
//         $response->setEtag($Etag);
//         $response->setPublic();     // make sure the response is public/cacheable
//         // $response->isNotModified($request);

     
//         return $response;
//    }
    

}
