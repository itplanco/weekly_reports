import { Component, EventEmitter, Input, OnChanges, Output } from '@angular/core';

import { FormatWeekPipe } from '../pipes/format-week.pipe';
import { Week } from '../models/week';

@Component({
    moduleId: module.id,
    selector: 'wr-week-input',
    templateUrl: 'week-input.component.html',
    styleUrls: ['week-input.component.css']
})
export class WeekInputComponent {

    @Input("week") inputWeek: Week;
    @Output("weekChanged") inputWeekChange: EventEmitter<Week> = new EventEmitter();
    @Input("canChange")canChange: boolean;

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