import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Week, WeeklyReportPublishStatus } from '../shared/';
import { ReportsService } from '../shared';

@Component({
    moduleId: module.id,
    selector: 'wr-report-publish-status-list',
    templateUrl: './report-publish-status-list.component.html',
    styleUrls: ['./report-publish-status-list.component.css']
})
export class ReportPublishStatusListComponent implements OnInit {
    week: Week;
    statusList: WeeklyReportPublishStatus[];

    constructor(private router: Router, private service: ReportsService) {
        this.week = Week.weekForToday();
    }

    ngOnInit() {
        this.statusList = this.service.getWeeklyReportStatus(this.week);
    }

    ngOnChanges() {
        this.statusList = this.service.getWeeklyReportStatus(this.week);
    }

    onDetailClick(status: WeeklyReportPublishStatus): void {
        this.router.navigate(['/reports/detail', status.year, status.weeknum, status.user_id]);
    }

    onCreateReportClick() {
        this.router.navigate(['/reports/input', this.week.year, this.week.weeknum]);
    }

    onWeekSelected(newWeek: Week) {
        this.week = newWeek;
    }
}
