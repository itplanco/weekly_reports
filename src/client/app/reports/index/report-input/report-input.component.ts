
import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { RouterModule, Router, ActivatedRoute } from '@angular/router';

export class ReportDetail {
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

export class ReportDetailService {
    getReportDetail(year: Number, weeknum: Number, user_id: Number): ReportDetail {
        return {
            createDate: new Date(),
            userName: "K.K",
            firstDate: new Date(),
            lastDate: new Date(),
            workArea: '作業場所',
            workContent: '作業内容',
            progress: '進捗',
            problem: '問題点',
            plans: '予定',
            proposal: '要望',
        };
    }
}

@Component({
    moduleId: module.id,
    selector: 'wr-report-input',
    templateUrl: 'report-input.component.html'
})
export class ReportInputComponent implements OnInit {
    year: Number;
    weeknum: Number;
    user_id: Number;
    detail: ReportDetail;
    @Output() close: EventEmitter<ReportDetail> = new EventEmitter();
    @Output() publish: EventEmitter<ReportDetail> = new EventEmitter();

    private service: ReportDetailService;
    constructor(private router: Router, private route: ActivatedRoute) {
        this.service = new ReportDetailService();
        this.year = route.snapshot.params['year'];
        this.weeknum = route.snapshot.params['weeknum'];
        this.user_id = route.snapshot.params['user_id'];
    }

    ngOnInit() {
        this.detail = this.service.getReportDetail(this.year, this.weeknum, this.user_id);
    }

    onCloseClick() {
        this.close.emit(this.detail);
    }

    onPublishClick() {
        this.publish.emit(this.detail);
    }
}