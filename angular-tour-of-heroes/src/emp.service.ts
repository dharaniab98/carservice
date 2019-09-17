import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
//import { Observable }  from 'rxjs/Observable';
//import { Observable } from 'rxjs';
import { Empdata } from './empdata';
import { Observable } from 'rxjs';
import { Status } from './status';
@Injectable({
  providedIn: 'root'
})
export class EmpService {
  http: HttpClient;
  constructor(http: HttpClient) {
    this.http = http;
  }

 // url = "http://www.dharani.com/dharani/index/getOrders/";//10006/eng"


  getOrderData(id: string, type: string): Observable<Empdata[]> {
    let url = "http://www.dharani.com/dharani/index/getOrders/"
   // console.log("service" + id + type);
    url =url + id + "/" + type;
    return this.http.get<Empdata[]>(url);
  }



  
  //method to update the order table 
  // url2="http://www.dharani.com/dharani/index/updateOrder"; //2/200/changetheoil/1  
  orderUpdateService(dat: Empdata): Observable<Status[]> {
   let  url2 = "http://www.dharani.com/dharani/index/updateOrder";
    for (const key in dat) {
      url2 = url2 + "/" + dat[key];
      //console.log(this.url2);
    }
    console.log(url2);
    return this.http.get<Status[]>(url2);
  }

}
