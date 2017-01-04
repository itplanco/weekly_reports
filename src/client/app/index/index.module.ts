import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }   from '@angular/forms';
import { MaterialModule } from '@angular/material';
import { IndexRoutingModule }   from './index.routing.module';
import { IndexComponent }  from './index.component';

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    MaterialModule.forRoot(),
    IndexRoutingModule,
  ],
  declarations: [
    IndexComponent
  ],
  exports: [IndexRoutingModule]
})
export class IndexModule { }