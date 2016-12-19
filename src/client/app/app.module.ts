import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent }  from './app.component';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from '@angular/material';
import { AppRoutingModule } from './app.routing';
import { LoginModule } from './login/login.module';
import { IndexModule } from './index/index.module';
import { DetailModule } from './detail/detail.module';
import { SidenavMenuComponent } from './common/sidenav-menu.component';

@NgModule({
  imports: [
    BrowserModule,
    LoginModule,
    IndexModule,
    DetailModule,
    AppRoutingModule,
    MaterialModule.forRoot()
  ],
  declarations: [
    AppComponent,
    SidenavMenuComponent,
  ],
  bootstrap: [ AppComponent ]
})
export class AppModule { }