import { Injectable } from '@angular/core';

import { Report, ReportDetail, WeeklyReportPublishStatus } from '../models/reports';
import { Week } from '../models/week';

@Injectable()
export class ReportsService {
    getReportDetail(year: Number, weeknum: Number, user_id: Number): ReportDetail {
        return {
            year,
            weeknum,
            user_id,
            createDate: new Date(),
            firstDate: new Date,
            lastDate: new Date(),
            userName: 'ユーザー名',
            workArea: '作業場所',
            workContent: '作業内容',
            progress: '進捗',
            problem: '問題点',
            plans: '予定',
            proposal: '要望',
        };
    }

    getWeeklyReportStatus(week: Week): WeeklyReportPublishStatus[] {
        return [
            {
                year: week.year,
                weeknum: week.weeknum,
                user_id: 1,
                userName: '',
                imageUrl: '',
                publishComment: null,
                publishDateTime: null
            },
            {
                year: week.year,
                weeknum: week.weeknum,
                user_id: 2,
                userName: '',
                imageUrl: '',
                publishComment: 'ていしゅつします',
                publishDateTime: (new Date())
            }
        ];
    }
}