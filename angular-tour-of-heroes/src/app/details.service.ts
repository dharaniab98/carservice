import { Injectable } from '@angular/core';
import { HttpClient }  from '@angular/common/http';
//import { Observable }  from 'rxjs/Observable';
//import { Observable } from 'rxjs';
import  { Hero }  from './hero';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class DetailsService {
  http:HttpClient;
  //url="http://www.dharani.com/api2.php";
 //  url="http://www.dharani.com/api.php?id=1";
   url="http://www.dharani.com/dharani/index/userData/hello/2";
  constructor(http:HttpClient) {
    this.http=http;
   }
  getdetails():Observable<Hero[] >{
    return this.http.get<Hero[]>(this.url);
  }
}
