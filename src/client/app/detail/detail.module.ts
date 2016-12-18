import { NgModule }      from '@angular/core';
import { FormsModule }   from '@angular/forms';
import { DetailRoutingModule }   from './detail.routing.module';
import { DetailComponent }  from './detail.component';

@NgModule({
  imports: [
    FormsModule,
    DetailRoutingModule
  ],
  declarations: [
    DetailComponent
  ],
  exports: [DetailRoutingModule]
})
export class DetailModule { }