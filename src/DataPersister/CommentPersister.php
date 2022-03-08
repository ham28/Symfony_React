<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Comment;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CommentPersister implements DataPersisterInterface
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function supports($data): bool
    {
        // TODO: Implement supports() method.
        return $data instanceof Comment;
    }

    public function persist($data)
    {
        // TODO: Implement persist() method.
        /**
         * @var Comment $data
         */
        $data->setCreatedAt(new \DateTimeImmutable('now'));

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        // TODO: Implement remove() method.

        $this->em->remove($data);
        $this->em->flush();
    }
}