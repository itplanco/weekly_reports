import { NgModule }            from '@angular/core';
import { RouterModule }        from '@angular/router';

import { DetailComponent }    from './detail.component';

@NgModule({
  imports: [RouterModule.forChild([
    { path: 'detail', component: DetailComponent}
  ])],
  exports: [RouterModule]
})
export class DetailRoutingModule {}


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/