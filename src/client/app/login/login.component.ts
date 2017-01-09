
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

import { LoginService } from './login.service';

@Component({
    moduleId: module.id,
    selector: 'wr-login',
    templateUrl: 'login.component.html'
})
export class LoginComponent implements OnInit {
    username: string;
    password: string;

    errorMessage: string;
    returnUrl: string;

    constructor(private router: Router, private route: ActivatedRoute, private loginService: LoginService) { }

    ngOnInit() {
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    onSubmit() {
        this.loginService.login(this.username, this.password)
            .subscribe((result) => {
                    if (result) {
                        this.router.navigate([this.returnUrl]);
                    }
                },
                error => {
                    this.errorMessage = 'ログインができません。ユーザー名・パスワードを確認してください。'
                });
    }
}