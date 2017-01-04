import { NgModule }            from '@angular/core';
import { RouterModule }        from '@angular/router';

import { LoginComponent }    from './login.component';

@NgModule({
  imports: [RouterModule.forChild([
    { path: 'login', component: LoginComponent}
  ])],
  exports: [RouterModule]
})
export class LoginRoutingModule {}


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/