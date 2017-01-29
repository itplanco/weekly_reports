import { Pipe, PipeTransform } from '@angular/core';

import { Week } from '../models/week';

@Pipe({
  name: 'week'
})
export class FormatWeekPipe implements PipeTransform {

  transform(value: Week): string {
    return value.year + '年' + value.weeknum + '週';
  }

}
