import { Component, OnInit } from '@angular/core';
import { Signdata } from  '../../signdata';
import { SignService } from 'src/sign.service';
import { NgForm, NgModel } from '@angular/forms';
import { FormControl } from '@angular/forms';
import {FormGroup} from '@angular/forms';
import {Status} from '../../status'

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {

 // reactiveForm: FormGroup;
  signdata=new Signdata();
  signservice:SignService;
  constructor(signservice:SignService) {
    this.signservice=signservice;
   }

  ngOnInit() {
  }

  //submitted = false;

  //onSubmit(data:NgModel) { console.log(data) }
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
          }
          else if(this.status.status=="2")
          {
             this.message="This mail id already registered";
          }
          else
          {
             this.message="please fill the valid details";
          }


      });
       // console.log(this.signdata);
      }
 
  // forData(dat:NgForm)
  // {
  //    console.log(dat.form.controls.name);
    // console.log(dat.form.status);
  
}
