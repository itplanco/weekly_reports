
import { Component, EventEmitter, Input, Output, OnChanges } from '@angular/core';
import { RouterModule, Router } from '@angular/router';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Week } from '../../models/week'

export class ReportSummary {
    user_id: string;
    name: string;
    imageUrl: string;
    publishComment: string;
    publishDateTime: Date;
}

export class ReportSummaryService {
    getWeeklyReportSummaries(week: Week): ReportSummary[] {
        return [{
            user_id: "1",
            name: "K.K",
            imageUrl: "image.jpg",
            publishComment: null,
            publishDateTime: null
        },
        {
            user_id: "2",
            name: "K.K2",
            imageUrl: "image.jpg",
            publishComment: 'ていしゅつします',
            publishDateTime: (new Date())
        }
        ];
    }
}

@Component({
    moduleId: module.id,
    selector: 'wr-report-summary',
    templateUrl: 'report-summary.component.html',
})
export class ReportSummaryComponent implements OnChanges {

    @Input() week: Week;
    @Output() detailSelected: EventEmitter<any> = new EventEmitter();

    summaries: ReportSummary[];
    private service: ReportSummaryService;

    constructor(private router: Router) {
        this.service = new ReportSummaryService();
    }

    ngOnChanges() {
        this.summaries = this.service.getWeeklyReportSummaries(this.week);
    }

    onDetailClick(summary: ReportSummary): void {
        this.detailSelected.emit({ year: this.week.year, weeknum: this.week.weeknum, user_id: summary.user_id });
    }
}