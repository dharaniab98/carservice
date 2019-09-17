import { Injectable } from '@angular/core';
import { HttpClient }  from '@angular/common/http';
import { Observable } from 'rxjs';
import { Status } from './status';
import { Signdata } from  './signdata';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class SignService {
   http:HttpClient;
  constructor(http:HttpClient) { 
    this.http=http;
  }


     url=""
        insertUser(dat:Signdata):Observable<Status>{
          this.url="http://www.dharani.com/dharani/index/insertUser"; 
              for (const key in dat) {
              this.url=this.url+"/"+dat[key];
                //console.log(this.url2);
              }
              console.log(this.url);
                return this.http.get<Status>(this.url);
      }
}
