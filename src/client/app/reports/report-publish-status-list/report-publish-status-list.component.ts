import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Week, WeeklyReportPublishStatus } from '../models/';
import { ReportsService } from '../services/';

@Component({
    selector: 'app-report-publish-status-list',
    templateUrl: './report-publish-status-list.component.html',
    styleUrls: ['./report-publish-status-list.component.css']
})
export class ReportPublishStatusListComponent implements OnInit {
    week: Week;
    statusList: WeeklyReportPublishStatus[];

    constructor(private router: Router, private service: ReportsService) {
    }

    ngOnInit() {
        this.week = Week.weekForToday();
        this.statusList = this.service.getWeeklyReportStatus(this.week);
    }

    ngOnChanges() {
        this.statusList = this.service.getWeeklyReportStatus(this.week);
    }

    onDetailClick(status: WeeklyReportPublishStatus): void {
        this.router.navigate(['detail', {
            year: status.year,
            weeknum: status.weeknum,
            user_id: status.user_id
        }]);
    }
}
