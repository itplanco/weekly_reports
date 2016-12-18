import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent }  from './app.component';
import { RouterModule, Routes } from '@angular/router';
import { AppRoutingModule } from './app.routing';
import { LoginModule } from './login/login.module';
import { IndexModule } from './index/index.module';
import { DetailModule } from './detail/detail.module';
import { HeaderComponent } from './common/header/header.component';
import { MaterialModule } from '@angular/material';

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
    HeaderComponent,
    //MdToolbar
  ],
  bootstrap: [ AppComponent ]
})
export class AppModule { }