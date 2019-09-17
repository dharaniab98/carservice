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
export class LoginsService {
  
private loggedIn =new BehaviorSubject<boolean>(true);

  
  
  http:HttpClient;
  constructor(http: HttpClient) {
    this.http=http;

  }
  isLoggedIn()
  {
        return this.loggedIn.asObservable();

  }
  setlogin(val:boolean){
    this.loggedIn.next(val);
  }

  setlogout()
  {
    this.loggedIn.next(true);
  }
//   LoginUser(gmail:string,password:string):Observable<Status>{
//     let login = [
//       { id: gmail, name: password },
      
//     ];
//    let url="http://www.dharani.com/dharani/user/edit"; 
//       return this.http.post<Status>(url,login,httpOptions);
//  }
 
// http://www.dharani.com/dharani/index/userLogin/dharani@gmail/dharani123
 
  LoginUser(gmail:string,password:string):Observable<Status>{
    let url="http://www.dharani.com/dharani/index/userLogin/"+gmail+"/"+password; 
    //let url="http://www.dharani.com/dharani/index/edit"; 
        return this.http.get<Status>(url);
}







}


