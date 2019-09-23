import { Component, OnInit } from '@angular/core';
import { ForgotsService } from '../forgots.service';
import { Status } from 'src/status';

@Component({
  selector: 'app-forgot',
  templateUrl: './forgot.component.html',
  styleUrls: ['./forgot.component.css']
})
export class ForgotComponent implements OnInit {

  email="";
  id:string;
  forgotService:ForgotsService;
  constructor(forgotService:ForgotsService) { 
   this.forgotService=forgotService;


  }
  
  display:boolean=true;
   message="";
 forgot()
 {
   this.message="";
   this.display=true;
 }

  ngOnInit() {
  }
  status:Status;
  onSubmit()
  {
    this.forgotService.resetLink(this.email).subscribe(data=>{
         // console.log(data);
          this.status=data;
          if(this.status.status=="1")
          {
            this.displayDiv();
            this.message="Check Mail for reset";
          }
          else if(this.status.status=="2")
          {
           // console.log(this.status.status);
            this.message="Invalid Mail";
            this.displayDiv();
          }
          else
          {
            this.message="Error in sending Mail";
            this.displayDiv();
          }
    });
   // console.log(this.email);
  }
  displayDiv()
  {
    this.display=false;
  }

}
