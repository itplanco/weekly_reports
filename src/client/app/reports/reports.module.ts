import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { MaterialModule } from '@angular/material';

import { ReportsComponent } from './reports.component';
import { ReportPublishStatusListComponent } from './report-publish-status-list/report-publish-status-list.component';
import { ReportDetailComponent } from './report-detail/report-detail.component';
import { ReportInputComponent } from './report-input/report-input.component';

import { WeekInputComponent } from './shared/components';
import { FormatWeekPipe, FormatWeekFromDayToDayPipe, PublishedFilterPipe, UnpublishedFilterPipe } from './shared/pipes';
import { ReportsService } from './shared/services';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        RouterModule,
        MaterialModule.forRoot(),
    ],
    declarations: [
        ReportsComponent,
        ReportPublishStatusListComponent,
        ReportDetailComponent,
        ReportInputComponent,
        WeekInputComponent,
        FormatWeekPipe,
        FormatWeekFromDayToDayPipe,
        PublishedFilterPipe,
        UnpublishedFilterPipe
    ],
    exports: [
        ReportsComponent,
        ReportPublishStatusListComponent,
        ReportDetailComponent,
        ReportInputComponent
    ],
    providers: [
        ReportsService
    ]
})
export class ReportsModule { }