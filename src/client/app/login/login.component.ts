
import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router'; 

@Component({
  selector: 'login',
  template: `
    <div (click)="onLoginClick()">
        ログイン
    </div>
    `
})
export class LoginComponent {
  constructor(private router: Router) {
    } 

    onLoginClick():void{
        this.router.navigate(['index']);
    }
  
}