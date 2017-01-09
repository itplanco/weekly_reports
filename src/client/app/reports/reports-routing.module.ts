import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { ReportsComponent } from './reports.component';
import { IndexComponent } from './index/index.component';
import { DetailComponent } from './detail/detail.component';

@NgModule({
  imports: [RouterModule.forChild([
    {
      path: '', component: ReportsComponent, children: [
        { path: '', component: IndexComponent },
        { path: 'detail/:year/:weeknum/:user_id', component: DetailComponent }
      ]
    }
  ])]
})
export class ReportsRoutingModule { }