import { Injectable } from '@angular/core';
import { Router, ActivatedRouteSnapshot, RouterStateSnapshot, CanLoad, CanActivate } from '@angular/router';
import { LoginService } from './login.service';

@Injectable()
export class LoginGuard implements CanLoad, CanActivate {
    constructor(private router: Router, private loginService: LoginService) { }

    canLoad(): boolean {
        return this.loginService.isLoggedIn();
    }

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
        if (this.loginService.isLoggedIn()) {
            return true;
        }

        this.router.navigate(['/login'], { queryParams: { returnUrl: state.url } })
        return false;
    }
}