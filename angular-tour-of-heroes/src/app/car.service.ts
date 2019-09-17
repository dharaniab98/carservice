import { Injectable } from '@angular/core';
import { HttpClient , HttpHeaders}  from '@angular/common/http';
import {Status}     from '../status';
import { Observable,BehaviorSubject } from 'rxjs';
const httpOptions = {
  headers: new HttpHeaders({
    
  })
};
import {Cardata} from './cardata'
import { doesNotThrow } from 'assert';
@Injectable({
  providedIn: 'root'
})


export class CarService {
  
  
//url="http://www.dharani.com/dharani/index/insertCarData/Ap2133/23444/bt450/red/tata/i20/3/nothhig/break"
url="http://www.dharani.com/dharani/index/insertCarData";
   http:HttpClient;
  



  constructor(http:HttpClient) { 
    this.http=http;
  }



  // urlstring(data:Cardata){
      
  // }
        putcardata(data:Cardata):Observable<Status>{

                for (const key in data) {
                    this.url=this.url+"/"+data[key];
                    
                }
                  //  console.log(this.url);
                  // this.http.post(this.url,"hello",httpOptions);
                  // console.log("hello");
                  return this.http.get<Status>(this.url);
                  
        }
}
