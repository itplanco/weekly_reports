import { Pipe, PipeTransform } from '@angular/core';
import { WeeklyReportPublishStatus } from '../models/reports';

@Pipe({
    name: 'unpublished'
})
export class UnpublishedFilterPipe implements PipeTransform {

    transform(reportStatus: WeeklyReportPublishStatus[]): any {
        return reportStatus.filter(s => s.publishDateTime == null);
    }
}
