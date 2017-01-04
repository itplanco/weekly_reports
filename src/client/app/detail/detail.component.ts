
import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router'; 

@Component({
  selector: 'detail',
  template: `
    <div (click)="onLoginClick()">
        Detail
    </div>
    `
})
export class DetailComponent {
  constructor(private router: Router) {
    } 

    onLoginClick():void{
        
    }
  
}