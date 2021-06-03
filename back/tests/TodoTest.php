<?php

use Laravel\Lumen\Application;

class TodoTest extends TestCase
{
    /**
     * /app/v1/to-do [GET]
     */
    public function testShouldReturnAllTasks()
    {
        /** @var Application */
        $allTasks = $this->get("/app/v1/to-do", []);

        $this->assertResponseStatus(200);
    }

    /**
     * /app/v1/to-do/:id [GET]
     */
    public function testShouldReturnTask()
    {
        $this->get("/app/v1/to-do/7", []);
        $this->seeStatusCode(200);
    }

    /**
     * /app/v1/to-do [POST]
     */
    public function testShouldCreateTask()
    {

        $parameters = [
            'title' => 'Task Test',
            'description' => 'Description test',
        ];

        $this->post("/app/v1/to-do", $parameters, []);
        $this->seeStatusCode(201);
    }

    /**
     * /app/v1/to-do/:id [PUT]
     */
    public function testShouldUpdateTask()
    {

        $parameters = [
            'title' => 'Update Task Test',
            'description' => 'Update Task Test',
        ];

        $this->put("/app/v1/to-do/7", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /app/v1/to-do/id [DELETE]
     */
    public function testShouldDeleteTask()
    {

        $this->delete("/app/v1/to-do/8", [], []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            true
        ]);
    }
}
