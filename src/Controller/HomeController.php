<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/comment", name="api_comments")
     */
    public function loadComment(CommentRepository $repository, SerializerInterface $serializer)
    {
        /*// TODO: Implement load() method.
        $comment = new Comment("J\'aime bien votre produit");
        $comment_2 = new Comment("Create your own dynamic, fake REST API. We were in need for some mock data for our project.");
        $comment_3 = new Comment("Like literally, some copy-pasta JSON file would have done the ...");
        $comment_4 = new Comment("GitHub - dbrekalo/fake-json-api-server: Simple json-api server running on client. ... return");
        $comment_5 = new Comment("Free fake API for testing and prototyping. Powered by JSON Server + LowDB. ... by the");
        $comment_6 = new Comment("following companies and Sponsors on GitHub, check them out");
        $comment_7 = new Comment("Get a full fake REST API with zero coding in less than 30 seconds (seriously) - GitHub -");
        $comment_8 = new Comment("typicode/json-server: Get a full fake REST API with zero coding in ...");
        $comment_9 = new Comment("Fake JSON generator tool to test APIs. Contribute to bijaydas/jsonfaker development by creating");
        $comment_10 = new Comment("View the specification Contribute on GitHub. If you've ever argued with your team about the way");
        $comment_11 = new Comment("your JSON responses should be formatted, JSON:API can be ...");


        $manager->persist($comment);
        $manager->persist($comment_2);
        $manager->persist($comment_3);
        $manager->persist($comment_4);
        $manager->persist($comment_5);
        $manager->persist($comment_6);
        $manager->persist($comment_7);
        $manager->persist($comment_8);
        $manager->persist($comment_9);
        $manager->persist($comment_10);
        $manager->persist($comment_11);

        $manager->flush();*/

        $datas = $repository->findAll();
//        $comments = array();
//        /**
//         * @var Comment $comment
//         */
//        foreach ($datas as $key => $comment)
//        {
//            $comments[$key]['id'] = $comment->getId();
//            $comments[$key]['comment'] = $comment->getComment();
//            $comments[$key]['createdAt'] = $comment->getCreatedAt()->format('Y-m-d H:i:s');
//            $comments[$key]['updatedAt'] = $comment->getUpdatedAt() == null ?$comment->getUpdatedAt() : $comment->getUpdatedAt()->format('Y-m-d H:i:s');
//        }
//        return new JsonResponse($comments);

        return new JsonResponse($serializer->serialize($datas, 'json'), 201, [], true);



    }

}
