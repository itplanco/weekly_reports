import { NgModule }      from '@angular/core';
import { FormsModule }   from '@angular/forms';
import { IndexRoutingModule }   from './index.routing.module';
import { IndexComponent }  from './index.component';

@NgModule({
  imports: [
    FormsModule,
    IndexRoutingModule
  ],
  declarations: [
    IndexComponent
  ],
  exports: [IndexRoutingModule]
})
export class IndexModule { }