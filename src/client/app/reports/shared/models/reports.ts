export class Report {
    year: Number;
    weeknum: Number;
    user_id: Number;
}

export class WeeklyReportPublishStatus extends Report {
    userName: string;
    imageUrl: string;
    publishComment: string;
    publishDateTime: Date;
}

export class ReportDetail extends Report {
    createDate: Date;
    userName: string;
    firstDate: Date;
    lastDate: Date;
    workArea: string;
    workContent: string;
    progress: string;
    problem: string;
    plans: string;
    proposal: string;
}