import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MaterialModule } from '@angular/material';

import { AppbarComponent } from './appbar/appbar.component';
import { SheetComponent } from './sheet/sheet.component';
import { ToolbarComponent } from './toolbar/toolbar.component';

@NgModule({
    imports: [
        CommonModule,
        MaterialModule.forRoot()
    ],
    declarations: [
        AppbarComponent,
        SheetComponent,
        ToolbarComponent
    ],
    exports: [
        AppbarComponent,
        SheetComponent,
        ToolbarComponent
    ]
})
export class SharedModule { }
