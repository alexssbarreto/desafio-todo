import { Component, OnInit } from '@angular/core';
import { Todo } from './todo';
import { TodoService } from './todo.service';

@Component({
    templateUrl: './todo-list.component.html',
    styleUrls: ['./todo-list.component.css']
})
export class TodoListComponent implements OnInit { 

    filteredTodos: Todo[] = [];

    _todos: Todo[] = [];
    
    _filterBy: string;

    constructor(private todoService: TodoService) { }

    ngOnInit(): void { 
        this.retrieveAll();
    }

    retrieveAll(): void { 
        this.todoService.retrieveAll().subscribe({
            next: todos => {
                this._todos = todos;
                this.filteredTodos = this._todos;
            },
            error: err => console.log('Error', err) 
        })
    }

    deleteById(todoId: number): void { 
        this.todoService.deleteById(todoId).subscribe({
            next: () => { 
                console.log('Deleted with success');
                this.retrieveAll();
            },
            error: err => console.log('Error', err)
        })
    }

    finish(todo: Todo): void { 
        this.todoService.finish(todo).subscribe({
            next: () => { 
                console.log('Finished with success');
                this.retrieveAll();
            },
            error: err => console.log('Error', err)
        })
    }

    set filter(value: string) { 
        this._filterBy = value;

        this.filteredTodos = this._todos.filter((todo: Todo) => todo.title.toLocaleLowerCase().indexOf(this._filterBy.toLocaleLowerCase()) > -1);
    }

    get filter() { 
        return this._filterBy;
    }

}