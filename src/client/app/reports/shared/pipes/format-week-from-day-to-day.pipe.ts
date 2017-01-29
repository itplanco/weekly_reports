import { Pipe, PipeTransform } from '@angular/core';
import { DatePipe } from '@angular/common';

import { Week } from '../models/week';

@Pipe({
    name: 'weekFromDayToDay'
})
export class FormatWeekFromDayToDayPipe implements PipeTransform {

    transform(value: Week): string {
        let date = new DatePipe('en-US');
        return date.transform(value.getFirstDate(), 'yyyy年M月d日') + ' ～ ' + date.transform(value.getLastDate(), 'yyyy年M月d日');
    }

}
