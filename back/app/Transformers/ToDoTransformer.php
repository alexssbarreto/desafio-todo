<?php

namespace App\Transformers;

use App\Entities\ToDo;

class ToDoTransformer
{
   
   public function transform(ToDo $todo)
   {
       return [
           'id' => $todo->getId(),
           'title' => $todo->getTitle(),
           'description' => $todo->getDescription(),
           'finished' => $todo->getFinished(),
           'created' => $todo->getCreated(),
           'updated' => $todo->getUpdated(),
       ];
   }

   public function transformAll(array $todos) {
      return array_map(
         function ($todo) {
           return $this->transform($todo);
         }, $todos
      );
   }

}