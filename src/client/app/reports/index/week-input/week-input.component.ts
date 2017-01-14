
import { Component, EventEmitter, Input, OnChanges, Output } from '@angular/core';
import { Week } from '../../models/week'

@Component({
    moduleId: module.id,
    selector: 'wr-week-input',
    templateUrl: 'week-input.component.html',
    styleUrls: ['week-input.component.css']
})
export class WeekInputComponent implements OnChanges {

    @Input("week") inputWeek: Week;
    @Output("weekChanged") inputWeekChange: EventEmitter<Week> = new EventEmitter();
    dispWeekString: String;
    startDate: Date;
    endDate: Date;

    ngOnChanges() {
        this.dispWeekString = this.inputWeek.year + '年' + this.inputWeek.weeknum + '週'
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