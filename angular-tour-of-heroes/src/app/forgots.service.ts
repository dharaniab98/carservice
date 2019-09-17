import { Injectable } from '@angular/core';
import {Status}     from '../status';
import { HttpClient }  from '@angular/common/http';
import { Observable,BehaviorSubject } from 'rxjs';

import { HttpHeaders } from '@angular/common/http';
const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type':  'application/json',
    'Authorization': 'my-auth-token'
  })
};
@Injectable({
  providedIn: 'root'
})
export class ForgotsService {
  http:HttpClient;
  constructor(http:HttpClient) {
    this.http=http;
   }

resetLink(gmail:string):Observable<Status>{
      let gmails = [{ id: gmail}];
     let url="http://www.dharani.com/dharani/user/edit"; 
        return this.http.post<Status>(url,gmails,httpOptions);
   }
}