import { NgModule } from '@angular/core'
import { CommonModule } from '@angular/common'
import { LocationZipcodeComponent } from './location-zipcode/location-zipcode.component'
import { SingleForecastComponent } from './single-forecast/single-forecast.component'
import { RouterModule } from '@angular/router'
import { FullForecastComponent } from './full-forecast/full-forecast.component'
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ForecastImagePipe } from './pipes/forecast-image.pipe'

@NgModule({
  declarations: [LocationZipcodeComponent, SingleForecastComponent, FullForecastComponent, ForecastImagePipe],
  imports: [CommonModule, RouterModule, FormsModule, ReactiveFormsModule],
  exports: [LocationZipcodeComponent, SingleForecastComponent, FullForecastComponent],
})
export class SharedModule { }
