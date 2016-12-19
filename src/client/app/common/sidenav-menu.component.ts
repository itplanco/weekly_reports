import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router';


@Component({
  moduleId: module.id,
  selector: 'wr-sidenav',
  templateUrl: 'sidenav-menu.component.html',
})

export class SidenavMenuComponent {
  constructor(private router: Router) {
  }
  onClick() {
    this.router.navigate(['login']);
  }
}