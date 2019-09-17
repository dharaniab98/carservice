import { Component, OnInit } from '@angular/core';
import {LoginsService}      from  '../logins.service'
import {Status} from '../../status'
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import  {CookieService}   from 'ngx-cookie-service';
import { switchMap } from 'rxjs/operators';
import { ControlService } from 'src/control.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {


  email?:string="";
  password?:string="";
  status:Status;
  router:Router;
  loginservice:LoginsService;
 cookieService:CookieService;
 controlService:ControlService;
  constructor(router:Router,loginservice:LoginsService,cookieService:CookieService,control:ControlService) {
    this.loginservice=loginservice;
    this.router=router;
    this.cookieService=cookieService;
    this.controlService=control;
    if(this.cookieService.get("login")=="true")
    {
      
    }
      

   }

  ngOnInit() {
  
    // this.cookieService.set( 'Test', 'Hello World');
    // let cookieValue = this.cookieService.get('Test');
    // console.log(cookieValue);

  }
  
  // sendlogin()
  // {
  //     this.controlService.sendMessage(false); 
  //     this.cookieService.set("login","false");  
  // }
  message:string;
  onSubmit()
  {
       this.loginservice.LoginUser(this.email,this.password).subscribe(xyz=>{
        this.status=xyz;
       console.log(this.status);
       console.log(this.status.user_id);
      console.log(this.status.type);
        if(this.status.status=="valid")
        {

          this.cookieService.set("login","true");
          this.loginservice.setlogin(false);
         // console.log("valid user");
          if(this.status.type=="wash" || this.status.type=="eng")   
          {
           // console.log('hello');
            this.router.navigate(['/employee',this.status.user_id,this.status.type]);
              this.message=""; 
          }
          else
          {
             this.router.navigate(['/cardetails',this.status.user_id,this.status.type]);
          }
        }
        else
        {
          this.router.navigate(['/login']);
          this.message="Invalid gmail and password"
        }
       }) ;

  }

}
