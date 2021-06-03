<?php

namespace App\Http\Controllers;

use App\Http\Validators\TodoValidator;
use App\Repository\ToDoRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    private $repository;

    protected $validator = TodoValidator::class;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * ListAll registers
     */
    public function index()
    {
        $posts = $this->repository->findAll();

        return response()->json($posts, '200');
    }

    /**
     * Show register
     */
    public function show($id)
    {
        try {
            return $this->repository->show($id);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Add register
     */
    public function add(Request $request)
    {
        try {
            $this->validate($request, $this->validator::$rules, $this->validator::$messages);

            $todo = $this->repository->add($request->toArray());

            return response()->json($todo, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update register
     */
    public function update($id, Request $request)
    {
        try {
            $this->validate($request, $this->validator::$rules, $this->validator::$messages);
        
            $todo = $this->repository->update((int)$id, $request->toArray());

            return response()->json($todo, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Delete register
     */
    public function delete($id)
    {
        try {
            $todo = $this->repository->delete((int)$id);

            return response()->json($todo, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
}
