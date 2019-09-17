import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { CookieService } from 'ngx-cookie-service';

@Injectable({
  providedIn: 'root'
})
export class LogauthGuard implements CanActivate {

  cookieService:CookieService;
  constructor(cookieService:CookieService)
  {
           this.cookieService=cookieService;
  }
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
  
   if(this.cookieService.get('login')=="true")
   {
      return false;
   }
   else
   {
         return true;
   }
  }
  
}
