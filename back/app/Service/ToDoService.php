<?php

namespace App\Service;

use App\Repository\ToDoRepository;

class ToDoService
{

    /**
     * @var ToDoRepository
     */
    protected $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Manager find data
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * 
     */
    public function findAll(array $params)
    {
        return $this->repository->findAll($params);
    }

    /**
     * Manager new data
     */
    public function create(array $data)
    {
        return $this->repository->add($data);
    }

    /**
     * Manager update data
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Manager delete data
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}