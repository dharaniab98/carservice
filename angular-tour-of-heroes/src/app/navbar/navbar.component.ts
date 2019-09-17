import { Component, OnInit } from '@angular/core';
import { CarService } from '../car.service';
import  {CookieService}   from 'ngx-cookie-service';    
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { ControlService } from 'src/control.service';
import { BehaviorSubject, Observable } from 'rxjs';
import { LoginsService } from '../logins.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  
  isLoggedIn$:Observable<boolean>;
  
  //login:boolean=true;
  sign:boolean=true;
  controlService:ControlService;
  cookieService:CookieService;
  router:Router;
  constructor(public loginService: LoginsService,cookieService:CookieService,control:ControlService,router:Router) { 
    this.controlService=control;
    this.cookieService=cookieService;
    this.router=router;
    //cookieService.set("sign","true");
   // cookieService.set("login","true");
  }
onlogin()
{
  
}
login;
logout()
{
 this.isLoggedIn$=this.loginService.isLoggedIn();
  this.loginService.setlogout();
 console.log("logout");
  this.cookieService.set("login","");
  this.router.navigate(['\login']);

}
  ngOnInit() {
   // this.isLoggedIn$=this.loginService.isLoggedIn();

     
    // this.controlService.loginMessage$.subscribe(message=>{
             
             if(this.cookieService.get("login")=="true")
             {
               
             }
             else
             {
              this.isLoggedIn$=this.loginService.isLoggedIn();
             }
             

    // });
  }

}
