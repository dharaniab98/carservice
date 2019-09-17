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
  forgotService:ForgotsService;
  constructor(forgotService:ForgotsService) { 
   this.forgotService=forgotService;


  }

  ngOnInit() {
  }
  status:Status;
  onSubmit()
  {
    this.forgotService.resetLink(this.email).subscribe(data=>{
          console.log(data);
    });
   // console.log(this.email);
  }

}
