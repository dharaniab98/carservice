import { Component, OnInit,OnDestroy } from '@angular/core';
import { EmpService } from 'src/emp.service';
import  { Empdata }  from '../../empdata';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { switchMap } from 'rxjs/operators';


@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.css']
})
export class EmployeeComponent implements OnInit ,OnDestroy{
  
 public  data=[];
  id:string;
  type:string;
  empservice:EmpService;
  constructor(private route: ActivatedRoute,private router: Router,empservice:EmpService) { 
    
    this.empservice=empservice;
     this.id = this.route.snapshot.paramMap.get('id');
    this.type=this.route.snapshot.paramMap.get('type');
  //this.hero$ = this.service.getHero(id);
  //  let a=this.route.paramMap.pipe(
  //     switchMap((params: ParamMap) =>
  //        params.get('id')
  //     ));
 // window.location.reload();
  this.empservice.getOrderData(this.id,this.type).subscribe(xyz => 
  {
      
     this.data=xyz;
      console.log(xyz);
    });

  //   console.log('hello');
  //  console.log(this.id);
  //  console.log(this.type);
   
  }
   //hero:Empdata;
  ngOnInit() {


  //   this.id = this.route.snapshot.paramMap.get('id');
  //   this.type=this.route.snapshot.paramMap.get('type');
  //this.availableOrders(this.id,this.type)
  //  console.log(this.id);
  //  console.log(this.type);

  }
  ngOnDestroy()
  {
      //   console.log("hello");
  }
  eng_extra_cost:number=0;
  remarks:string="";
  availableOrders(eng_id:string,type:string)
  {
  //  console.log("orderavial"+eng_id+type);
  this.eng_extra_cost=0;
  this.remarks="";
    this.empservice.getOrderData(eng_id,type).subscribe(xyz => 
      {
        
       this.data=xyz;
        console.log(this.data[0]);
      });


  }


  orderStatus=[];
  orderUpdate(dat)
  {
       dat.eng_extra_cost=this.eng_extra_cost;
       dat.remarks=this.remarks;
       if(dat.status==0)
       {
        dat.status=1;
       }
       else if(dat.status==1)
       {
             dat.status=2;
       }
       else
       {
              dat.status=4;
       }
       console.log(dat);
       this.empservice.orderUpdateService(dat).subscribe(xyz => 
       { 
         this.orderStatus=xyz;
       this.availableOrders(this.id,this.type);
          //  window.location.reload();
           console.log(this.orderStatus);
         });


  }

}
