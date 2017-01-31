import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoginComponent, LoginGuard } from './login/';
import { ReportsComponent, ReportPublishStatusListComponent, ReportDetailComponent, ReportInputComponent } from './reports/';

const routes: Routes = [
    { path: '', redirectTo: 'reports', pathMatch: 'full' },
    { path: 'login', component: LoginComponent },
    {
        path: 'reports',
        component: ReportsComponent,
        canActivate: [LoginGuard],
        children: [
            { path: '', component: ReportPublishStatusListComponent },
            { path: 'input/:year/:weeknum', component: ReportInputComponent },
            { path: 'detail/:year/:weeknum/:user_id', component: ReportDetailComponent }
        ]
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule],
    providers: []
})
export class AppRoutingModule { }
