import { Todo } from './todo';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
    providedIn: 'root'
})
export class TodoService { 

    private todoUrl: string = 'http://localhost:8000/app/v1/to-do';

    constructor(private httpClient: HttpClient) { }

    retrieveAll(): Observable<Todo[]> {
        return this.httpClient.get<Todo[]>(this.todoUrl);
    }

    retrieveById(id: number): Observable<Todo> { 
        return this.httpClient.get<Todo>(`${this.todoUrl}/${id}`);
    }

    save(todo: Todo): Observable<Todo> { 
        if(todo.id) { 
            return this.httpClient.put<Todo>(`${this.todoUrl}/${todo.id}`, todo);
        } else { 
            return this.httpClient.post<Todo>(`${this.todoUrl}`, todo);
        }
    }

    finish(todo: Todo): Observable<Todo> { 
        todo.finished = todo.finished ? 0 : 1;
        return this.httpClient.put<Todo>(`${this.todoUrl}/${todo.id}`, todo);
    }

    deleteById(id: number): Observable<any> {
        return this.httpClient.delete<any>(`${this.todoUrl}/${id}`);
    }

}