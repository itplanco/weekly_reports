//週入力クラス
export class Week {
    year: number = 2017;
    weeknum: number = 1;

    constructor(year: number, weeknum: number) {
        this.year = year;
        this.weeknum = weeknum;
    }

    static calculationWeeks(date: Date): number {
        var firstday = new Date(date.getFullYear(), 0, 1);
        var fulldays = Math.floor((date.getTime() - firstday.getTime()) / (1000 * 86400));
        return Math.floor((fulldays - date.getDay() + 12) / 7);
    }

    lastWeek(): Week {
        let week: number;
        let firstDate = this.getFirstDate();
        firstDate.setDate(firstDate.getDate() - 7);
        week = Week.calculationWeeks(firstDate);
        return new Week(firstDate.getFullYear(), week);
    }

    nextWeek(): Week {
        let week: number;
        let firstDate = this.getFirstDate();
        firstDate.setDate(firstDate.getDate() + 7);
        week = Week.calculationWeeks(firstDate);
        return new Week(firstDate.getFullYear(), week);
    }

    getFirstDate(): Date {
        let firstDate = new Date(this.year, 0, 1);
        firstDate.setDate(firstDate.getDate() + (this.weeknum - 1) * 7 + 1);
        return firstDate;
    }

    getLastDate(): Date {
        let lastDate = new Date(this.year, 0, 1);
        lastDate.setDate(lastDate.getDate() + (this.weeknum - 1) * 7 + 7);
        return lastDate;
    }

    static weekForToday(): Week {
        let date = new Date();
        return new Week(date.getFullYear(), this.calculationWeeks(date));
    }
}