import { Injectable } from '@angular/core';
import {Subject} from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class ControlService {

  constructor() { }
  
  private _loginMessageSource=new Subject<boolean>();
  loginMessage$=this._loginMessageSource.asObservable();

  sendMessage(message:boolean)
  {
    this._loginMessageSource.next(message);
  }
 


}
