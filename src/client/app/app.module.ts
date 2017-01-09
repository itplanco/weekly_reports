import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent }  from './app.component';
import { MaterialModule } from '@angular/material';
import { AppRoutingModule } from './app.routing';
import { LoginModule } from './login/login.module';
import { ReportsModule } from './reports/reports.module';
import { SidenavMenuComponent } from './common/sidenav-menu.component';

@NgModule({
  imports: [
    BrowserModule,
    LoginModule,
    AppRoutingModule,
    ReportsModule,
    MaterialModule.forRoot()
  ],
  declarations: [
    AppComponent,
    SidenavMenuComponent,
  ],
  bootstrap: [ AppComponent ]
})
export class AppModule { }