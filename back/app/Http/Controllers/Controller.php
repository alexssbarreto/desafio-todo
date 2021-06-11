<?php

namespace App\Http\Controllers;

use App\Http\Validators\TodoValidator;
use App\Service\ToDoService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    private $service;

    protected $validator = TodoValidator::class;

    public function __construct(ToDoService $service)
    {
        $this->service = $service;
    }

    /**
     * ListAll registers
     */
    public function index()
    {
        $posts = $this->service->findAll([]);

        return response()->json($posts, '200');
    }

    /**
     * Show register
     */
    public function show($id)
    {
        try {
            return $this->service->find($id);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Add register
     */
    public function add(Request $request)
    {
        $this->validate($request, $this->validator::$rules, $this->validator::$messages);

        try {
            $todo = $this->service->create($request->toArray());

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
        $this->validate($request, $this->validator::$rules, $this->validator::$messages);

        try {        
            $todo = $this->service->update((int)$id, $request->toArray());

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
            $todo = $this->service->delete((int)$id);

            return response()->json($todo, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
}
