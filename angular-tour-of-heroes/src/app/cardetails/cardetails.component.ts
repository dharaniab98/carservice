import { Component, OnInit } from '@angular/core';
import {NgForm} from '@angular/forms';
import {Cardata} from '../cardata';
import { CarService } from '../car.service';
import { Status } from 'src/status';
@Component({
  selector: 'app-cardetails',
  templateUrl: './cardetails.component.html',
  styleUrls: ['./cardetails.component.css']
})
export class CardetailsComponent implements OnInit {


  status:Status;
  car = new Cardata("Ap21568", 'cd1234', "bt12234","tata","i20","red",5,"Fine","breaks");
  public carservice:CarService;
  constructor(carservice:CarService) { 
    this.carservice=carservice;
  }

  ngOnInit() {
  }
  // carDetails(cardata:NgForm)
  // {
  //     // console.log(cardata);
  //     // console.log(cardata.form.controls)
  //      console.log(this.car.license);
      
  //  }
   
   carDetails() 
   {
      //console.log('hello');
    this.carservice.putcardata(this.car).subscribe(xyz => 
      // console.log(data[0].id);
      {this.status=xyz;
      //console.log(this.hero);
     console.log(this.status);
     if(this.status.status=='valid')
     {
          console.log("car Acepted");
     }
     else
     {
          console.log("No slots are available for the day");

     }


      }); 
   
   }

  
}
