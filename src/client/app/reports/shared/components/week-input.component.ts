import { Component, EventEmitter, Input, Output } from '@angular/core';

import { FormatWeekPipe } from '../pipes/format-week.pipe';
import { Week } from '../models/week';

@Component({
    moduleId: module.id,
    selector: 'wr-week-input',
    templateUrl: 'week-input.component.html',
    styleUrls: ['week-input.component.css']
})
export class WeekInputComponent {

    @Input("week") currentWeek: Week;
    @Output("weekSelected") weekSelected: EventEmitter<Week> = new EventEmitter();
    @Input("disabled") disabled: boolean;

    onLastWeekClick(): void {
        this.onWeekSelect(this.currentWeek.lastWeek());
    }

    onNextWeekClick(): void {
        this.onWeekSelect(this.currentWeek.nextWeek());
    }

    onThisWeekClick(): void {
        this.onWeekSelect(Week.weekForToday());
    }

    private onWeekSelect(week: Week) {
        this.weekSelected.emit(week);
    }
}