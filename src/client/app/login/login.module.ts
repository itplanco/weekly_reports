import { NgModule }      from '@angular/core';
import { FormsModule }   from '@angular/forms';
import { LoginRoutingModule }   from './login.routing.module';
import { LoginComponent }  from './login.component';

@NgModule({
  imports: [
    FormsModule,
    LoginRoutingModule
  ],
  declarations: [
    LoginComponent
  ],
  exports: [LoginRoutingModule]
})
export class LoginModule { }