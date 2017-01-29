import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { WeekInputComponent } from '../shared';
import { PublishedFilterPipe, UnpublishedFilterPipe } from '../shared';
import { Week, WeeklyReportPublishStatus } from '../shared/';
import { ReportsService } from '../shared';

@Component({
    moduleId: module.id,
    selector: 'wr-report-publish-status-list',
    viewProviders: [
        WeekInputComponent,
        PublishedFilterPipe,
        UnpublishedFilterPipe
    ],
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
