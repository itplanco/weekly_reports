import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router'; 
//import { MdToolbar } from '@angular/material/toolbar';


@Component({
  selector: 'header',
  templateUrl:'./app/common/header/header.component.html',
})
export class HeaderComponent {
    constructor(private router: Router) {
    }
  onClick(){
      this.router.navigate(['login']);
  }
  
}