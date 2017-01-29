import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { MaterialModule } from '@angular/material';

import { ReportPublishStatusListComponent } from './report-publish-status-list/report-publish-status-list.component';
import { ReportDetailComponent } from './report-detail/report-detail.component';
import { ReportInputComponent } from './report-input/report-input.component';

import { WeekInputComponent } from './shared/components';
import { FormatWeekPipe, PublishedFilterPipe, UnpublishedFilterPipe } from './shared/pipes';
import { ReportsService } from './shared/services';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        MaterialModule.forRoot(),
    ],
    declarations: [
        ReportPublishStatusListComponent,
        ReportDetailComponent,
        ReportInputComponent,
        WeekInputComponent,
        FormatWeekPipe,
        PublishedFilterPipe,
        UnpublishedFilterPipe
    ],
    exports: [
        ReportPublishStatusListComponent,
        ReportDetailComponent,
        ReportInputComponent
    ],
    providers: [
        ReportsService
    ]
})
export class ReportsModule { }