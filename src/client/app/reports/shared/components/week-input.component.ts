import { Component, EventEmitter, Input, OnChanges, Output } from '@angular/core';

import { FormatWeekPipe } from '../pipes/format-week.pipe';
import { Week } from '../models/week';

@Component({
    moduleId: module.id,
    selector: 'wr-week-input',
    viewProviders: [
        FormatWeekPipe
    ],
    templateUrl: 'week-input.component.html',
    styleUrls: ['week-input.component.css']
})
export class WeekInputComponent implements OnChanges {

    @Input("week") inputWeek: Week;
    @Output("weekChanged") inputWeekChange: EventEmitter<Week> = new EventEmitter();
    startDate: Date;
    endDate: Date;

    ngOnChanges() {
        this.startDate = this.inputWeek.getFirstDate();
        this.endDate = this.inputWeek.getLastDate(); 
    }

    onLastWeekClick(): void {
        this.onWeekChange(this.inputWeek.lastWeek());
    }

    onNextWeekClick(): void {
        this.onWeekChange(this.inputWeek.nextWeek());
    }

    private onWeekChange(week: Week) {
        this.inputWeek = week;
        this.inputWeekChange.emit(week);

    }

}