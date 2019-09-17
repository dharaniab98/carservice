import { Component ,OnInit} from '@angular/core';
import {CookieService}  from 'ngx-cookie-service'
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  
  cookieService:CookieService;
  constructor(cookieService:CookieService){
   this.cookieService=cookieService;
   console.log(this.cookieService.get("login"));
  }
 
  ngOnInit() {
   

  }

  title = 'Car Cleaners';
  val=false;
}
