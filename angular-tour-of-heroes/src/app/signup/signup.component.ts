import { Component, OnInit } from '@angular/core';
import { Signdata } from  '../../signdata';
import { SignService } from 'src/sign.service';
import { NgForm, NgModel } from '@angular/forms';
import { FormControl } from '@angular/forms';
import {FormGroup} from '@angular/forms';
import {Status} from '../../status';
import {Router} from '@angular/router';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {

 // reactiveForm: FormGroup;
  signdata=new Signdata();
  signservice:SignService;
  router:Router;
  constructor(signservice:SignService,router:Router) {
    this.signservice=signservice;
    this.router=router;
   }

  ngOnInit() {
  }

  //submitted = false;

  //onSubmit(data:NgModel) { console.log(data) }
display:boolean=true;
loginbut:boolean=false;

status:Status;
message="";


      userData()
      {
        //console.log(dat);
        this.signservice.insertUser(this.signdata).subscribe(xyz => 
      
        { this.status=xyz;
        
          console.log(this.status);
          if(this.status.status=="1")
          {
                 this.message="sucessfull please login";
                 this.display=false;
                 this.loginbut=true;
          }
          else if(this.status.status=="2")
          {
             this.message="This mail id already registered";
             this.display=false;
             this.loginbut=false;

          }
          else
          {
             this.message="please fill the valid details";
             this.display=false;
             this.loginbut=false;
          }


      });
       // console.log(this.signdata);
      }
    
      messageDialogue()
      {
        console.log("method called");
        if(this.status.status=="1")
        {
          this.router.navigate(['../login']);
          
        }
        else
        {
          //this.router.navigate(['/signup']);
          this.display=true;
          
          
        }

      }

  // forData(dat:NgForm)
  // {
  //    console.log(dat.form.controls.name);
    // console.log(dat.form.status);
  
}
