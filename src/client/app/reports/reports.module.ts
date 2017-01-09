import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from '@angular/material';
import { ReportsRoutingModule } from './reports-routing.module';
import { ReportsComponent } from './reports.component';
import { IndexComponent } from './index/index.component';
import { DetailComponent } from './detail/detail.component';
import { WeekInputComponent } from './index/week-input/week-input.component';
import { ReportSummaryComponent } from './index/report-summary/report-summary.component';
import { ReportInputComponent } from './index/report-input/report-input.component';
import { HttpModule, JsonpModule } from '@angular/http';


@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        RouterModule,
        MaterialModule.forRoot(),
        ReportsRoutingModule,
        HttpModule,
        JsonpModule
    ],
    declarations: [
        ReportsComponent,
        IndexComponent,
        DetailComponent,
        WeekInputComponent,
        ReportSummaryComponent,
        ReportInputComponent
    ],
    exports: [ReportsRoutingModule],
    providers:[]
})
export class ReportsModule { }