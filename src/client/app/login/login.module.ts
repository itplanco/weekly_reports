import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { MaterialModule } from '@angular/material';

import { LoginComponent } from './login.component';
import { LoginService, LoginGuard } from './shared/services';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule.forRoot()
  ],
  declarations: [
    LoginComponent
  ],
  providers: [
    LoginService,
    LoginGuard
  ],
  exports: [
    LoginComponent
  ]
})
export class LoginModule { }
