import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Todo } from './todo';
import { TodoService } from './todo.service';

@Component({
    templateUrl: './todo-info.component.html'
})
export class TodoInfoComponent implements OnInit {

    todo: Todo;

    constructor(private activatedRoute: ActivatedRoute, private router: Router, private todoService: TodoService) { }
    
    ngOnInit(): void {
        if (this.activatedRoute.snapshot.paramMap.get('id')) {
            this.todoService.retrieveById(+this.activatedRoute.snapshot.paramMap.get('id')).subscribe({
                next: todo => this.todo = todo,
                error: err => console.log('Error', err)
            });
        } else {
            this.todo = new Todo();
        }
    }

    save(): void {
        this.todoService.save(this.todo).subscribe({
            next: todo => this.router.navigate(['/tasks']),
            error: err => console.log('Error', err)
        });
    }

}