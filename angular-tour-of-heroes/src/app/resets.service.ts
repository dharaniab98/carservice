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
export class ResetsService {

  http:HttpClient;
  constructor(http:HttpClient) {
    this.http=http;
   }

  resetPassword(password:string,id:string):Observable<Status>{
    let data = [{ pass: password,id:id}];
   let url="http://www.dharani.com/dharani/user/reset"; 
      return this.http.post<Status>(url,data,httpOptions);
 }

}
