<?php

namespace App\Repository;

use App\Entities\ToDo;
use App\Transformers\ToDoTransformer;
use Doctrine\ORM\EntityManagerInterface;

class ToDoRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Find all data
     */
    public function findAll()
    {
        $todos = $this->entityManager
            ->getRepository(ToDo::class)
            ->findBy([], ['id' => 'desc']);

        $transformer = new ToDoTransformer();

        return $transformer->transformAll($todos);
    }

    /**
     * Find one data
     */
    public function show($id)
    {
        try {
            $todo = $this->entityManager
                ->getRepository(ToDo::class)
                ->findOneBy([
                    'id' => $id
                ]);

            if (!$todo) {
                throw new \Exception('Register not found');
            }

            $transformer = new ToDoTransformer();
            return $transformer->transform($todo);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Add new data
     */
    public function add(array $data)
    {
        $todo = new ToDo();
        $todo->setTitle($data['title']);
        $todo->setDescription($data['description'] ?? null);
        $todo->setFinished($data['finished'] ?? null);

        return $this->store($todo);
    }


    /**
     * Update data
     */
    public function update(int $id, array $data)
    {
        /** @var ToDo */
        $todo = $this->entityManager
            ->getRepository(ToDo::class, $id)
            ->findOneBy([
                'id' => $id
            ]);
        
        if (!$todo) {
            throw new \Exception('Register not found.');
        }

        $todo->setTitle($data['title']);
        $todo->setDescription($data['description'] ?? null);
        $todo->setFinished($data['finished'] ?? null);

        return $this->store($todo);
    }

    /**
     * Delete data
     */
    public function delete(int $id)
    {
        try {
            /** @var ToDo */
            $todo = $this->entityManager
                ->getRepository(ToDo::class, $id)
                ->findOneBy([
                    'id' => $id
                ]);

            $this->entityManager->remove($todo);
            $this->entityManager->flush();

            return true;
        } catch (\Exception $e) {
            throw new \Exception('Register not found.');
        }
    }

    /**
     * Save data
     */
    private function store(ToDo $todo)
    {
        try {
            $this->entityManager->persist($todo);
            $this->entityManager->flush();

            $transformer = new ToDoTransformer();
            return $transformer->transform($todo);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
