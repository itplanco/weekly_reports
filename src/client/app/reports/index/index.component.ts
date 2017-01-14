
import { Component, OnInit } from '@angular/core';
import { RouterModule, Router } from '@angular/router';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Week } from '../models/week'

@Component({
    moduleId: module.id,
    selector: 'wr-report-index',
    templateUrl: 'index.component.html',
    styleUrls: ['index.component.css']
})
export class IndexComponent implements OnInit {

    inputWeek: Week;
    modalWindowShowing: boolean = false;

    constructor(private router: Router, private http: Http) {
    }

    ngOnInit() {
        this.inputWeek = Week.weekForToday();
    }

    onDetailClick(event: any): void {
        this.router.navigate(['reports/detail/', event.year, event.weeknum, event.user_id]);
    }

    onWeekChanged(week: Week): void {
        this.inputWeek = week;
    }

    onCreateReportClick() {
        this.modalWindowShowing = true;
    }
}