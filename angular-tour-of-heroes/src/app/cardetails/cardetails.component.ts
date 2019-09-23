import { Component, OnInit } from '@angular/core';
import {NgForm} from '@angular/forms';
import {Cardata} from '../cardata';
import { CarService } from '../car.service';
import { Status } from 'src/status';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
@Component({
  selector: 'app-cardetails',
  templateUrl: './cardetails.component.html',
  styleUrls: ['./cardetails.component.css']
})
export class CardetailsComponent implements OnInit {
  message:string;
  user_id;
  status:Status;
 // car = new Cardata("Ap21568", 'cd1234', "bt12234","tata","i20","red",5,"Fine","breaks");
 car=new Cardata();
  public carservice:CarService;
  constructor(carservice:CarService,route:ActivatedRoute) { 
    this.carservice=carservice;
    this.user_id = route.snapshot.paramMap.get('id');
  }

  ngOnInit() {
  }
  // carDetails(cardata:NgForm)
  // {
  //     // console.log(cardata);
  //     // console.log(cardata.form.controls)
  //      console.log(this.car.license);
      
  //  }
  
  display:boolean=true;

  reqService()
  {
    this.display=true;
  }



   carDetails() 
   {
      //console.log('hello');
    this.car.user_id=this.user_id;
    console.log(this.car);
    this.carservice.putcardata(this.car).subscribe(xyz => 
      // console.log(data[0].id);
      {this.status=xyz;
      //console.log(this.hero);
     console.log(this.status);
     if(this.status.status=='valid')
     {
          this.message="car Accepted"
          this.display=false;
          //console.log("car Acepted");
     }
     else if(this.status.status=='invalid')
     {
         // console.log("No slots are available for the day");
         this.message='No slots are available for the day';
         this.display=false;


     }
     else
     {
           this.message='Car Already in Service';
           this.display=false;
     }


      }); 
   
   }

  
}
