import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Week, ReportDetail, ReportsService } from '../shared/'

@Component({
    moduleId: module.id,
    selector: 'wr-report-detail',
    templateUrl: './report-detail.component.html',
    styleUrls: ['./report-detail.component.css']
})
export class ReportDetailComponent implements OnInit {
    week: Week;
    detail: ReportDetail;

    constructor(private router: Router, private route: ActivatedRoute, private service: ReportsService) {
        this.service = new ReportsService();
    }

    ngOnInit() {
        var year = this.route.snapshot.params['year'];
        var weeknum = this.route.snapshot.params['weeknum'];
        var user_id = this.route.snapshot.params['user_id'];
        this.week = new Week(year, weeknum);
        this.detail = this.service.getReportDetail(year, weeknum, user_id);
    }

    onWeekChanged(newWeek: Week) {
        this.week = newWeek;
    }

    onCloseClick() {
        this.router.navigate(['']);
    }
}
