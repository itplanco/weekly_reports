
import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router'; 

@Component({
  selector: 'index',
  template: `
    <div (click)="onLoginClick()">
        Index
    </div>
    `
})
export class IndexComponent {
  constructor(private router: Router) {
    } 

    onLoginClick():void{
        this.router.navigate(['detail']);
    }
  
}