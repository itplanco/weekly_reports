
import { Component } from '@angular/core';
import { RouterModule, Router } from '@angular/router';

export class WeeklyReportSummary {
    name: string;
    imageUrl: string;
    publishComment: string;
    publishDateTime: Date;
}

@Component({
    moduleId: module.id,
    selector: 'wr-weekly-report-summary',
    templateUrl: 'index.component.html',
})
export class IndexComponent {
    summaries: WeeklyReportSummary[] = [
        {
            name: "K.K",
            imageUrl: "image.jpg",
            publishComment: null,
            publishDateTime: null
        }
    ];

    constructor(private router: Router) {
    }

    onDetailClick(): void {
        this.router.navigate(['detail']);
    }
}