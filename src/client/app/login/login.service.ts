import { Injectable, EventEmitter } from '@angular/core';
import { Http, Headers } from '@angular/http';

import { Subject } from 'rxjs/Subject';

@Injectable()
export class LoginService {
    private loggedIn: boolean;
    public loginStateChanged: EventEmitter<boolean>;

    constructor(private http: Http) {
        this.loginStateChanged = new EventEmitter<boolean>();
        this.loggedIn = !!localStorage.getItem('auth_token');
    }

    login(email: String, password: String) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        return this.http.post('/api/login',
                JSON.stringify({ email, password }),
                { headers }
            )
            .map(res => res.json())
            .map(body => {
                if (body.success) {
                    localStorage.setItem('auth_token', body.auth_token);
                    this.loggedIn = true;
                    this.loginStateChanged.emit(true);
                }
                return body.success;
            });
    }

    logout() {
        localStorage.removeItem('auth_token');
        this.loggedIn = false;
        this.loginStateChanged.emit(false);
    }

    isLoggedIn() {
        return this.loggedIn;
    }
}