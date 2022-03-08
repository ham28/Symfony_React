<?php


namespace App\DataFixtures;


use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
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

        $manager->flush();
    }

}