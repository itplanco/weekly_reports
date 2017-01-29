import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

import { ReportDetail, ReportsService } from '../shared';

@Component({
    moduleId: module.id,
    selector: 'wr-report-input',
    templateUrl: 'report-input.component.html',
    styleUrls: ['report-input.component.css']
})
export class ReportInputComponent implements OnInit {
    user: any;
    detail: ReportDetail;

    constructor(private router: Router, private route: ActivatedRoute, private service: ReportsService) {
    }

    ngOnInit() {
        var year = this.route.snapshot.params['year'];
        var weeknum = this.route.snapshot.params['weeknum'];
        var user_id = 1;
        this.detail = this.service.getReportDetail(year, weeknum, user_id);
        if (!this.detail) {
            this.detail = new ReportDetail();
            this.detail.year = year;
            this.detail.weeknum = weeknum;
            this.detail.user_id = user_id;
        }
    }

    onCloseClick() {
        this.router.navigate(['']);
    }

    onPublishClick() {
        this.router.navigate(['']);
    }
}