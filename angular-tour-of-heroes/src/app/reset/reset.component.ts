import { Component, OnInit } from '@angular/core';
import { ResetsService } from '../resets.service';

@Component({
  selector: 'app-reset',
  templateUrl: './reset.component.html',
  styleUrls: ['./reset.component.css']
})
export class ResetComponent implements OnInit {
  password1="";
  password2="";
  resetService:ResetsService;
  constructor(resetService:ResetsService) { 
    this.resetService=resetService;
  }

  ngOnInit() {
  }
 message="";
  onSubmit()
  {
    if(this.password1==this.password2)
    {
      this.resetService.resetPassword(this.password1).subscribe(data=>{
      console.log(data);
         });
    }
    else
    {
      this.message="please check the password";
    }
  }

}
