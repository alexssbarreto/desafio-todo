import { NgModule } from '@angular/core';
import { TodoListComponent } from './todo-list.component';
import { TodoInfoComponent } from './todo-info.component';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@NgModule({
    declarations: [
        TodoListComponent,
        TodoInfoComponent
    ], 
    imports: [
        CommonModule,
        FormsModule,
        RouterModule.forChild([
            {
                path: 'tasks', component: TodoListComponent
            },
            {
                path: 'tasks/info', component: TodoInfoComponent
            },
            {
                path: 'tasks/info/:id', component: TodoInfoComponent
            }
        ])
    ]
})
export class TodoModule { 

}