import { Component } from '@angular/core';
import { ForecastService, LocationForecast } from '../../services/forecast.service';


@Component({
  selector: 'app-current-forecast.page',
  templateUrl: './current-forecast.page.component.html',
  styleUrls: ['./current-forecast.page.component.scss']
})
export class CurrentForecastPageComponent {

  constructor(
    private forecastService: ForecastService
  ) { }

  public handleEnteredLocation(enteredLocation: LocationForecast) {
    this.forecastService.saveLocationForecast(enteredLocation)
  }
}
