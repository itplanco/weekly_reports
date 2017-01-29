import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { MaterialModule } from '@angular/material';
import { AppRoutingModule } from './app-routing.module';
import { LoginModule } from './login/login.module';
import { ReportsModule } from './reports/reports.module';

import { AppComponent } from './app.component';
import { SidenavMenuComponent } from './common/sidenav-menu.component';

@NgModule({
  declarations: [
    AppComponent,
    SidenavMenuComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    MaterialModule.forRoot(),
    AppRoutingModule,
    LoginModule,
    ReportsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
