import { Component, OnInit } from '@angular/core';
import { ResetsService } from '../resets.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import {Status}     from '../../status';
@Component({
  selector: 'app-reset',
  templateUrl: './reset.component.html',
  styleUrls: ['./reset.component.css']
})
export class ResetComponent implements OnInit {
  password1="";
  password2="";
  id:string;
  route:Router;
  resetService:ResetsService;
  constructor(resetService:ResetsService,route:Router,router:ActivatedRoute) { 
    this.resetService=resetService;
    this.id=router.snapshot.paramMap.get('code');
  }

  ngOnInit() {
  }
 message="";
 status:Status;
  onSubmit()
  {
    if(this.password1==this.password2)
    {
      this.resetService.resetPassword(this.password1,this.id).subscribe(data=>{
      console.log(data);
        this.status=data;
        if(this.status.status=="1")
        {
          this.message="Password Updated";
        }
        else if(this.status.status=="2")
        {
          this.message="Reset Link expired";
        }
         });
    }
    else
    {
      this.message="please check the password";
    }
  }

}
