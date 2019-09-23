import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeroesComponent } from './heroes/heroes.component';
import { HttpClientModule } from '@angular/common/http';
import { DetailsService } from './details.service';
import { SignupComponent } from './signup/signup.component';
import { LoginComponent } from './login/login.component';
import { CardetailsComponent } from './cardetails/cardetails.component';
import { FormsModule} from '@angular/forms';
import { CarService } from './car.service';
import { EmployeeComponent } from './employee/employee.component';
import { EmpService } from 'src/emp.service';
import { SignService } from 'src/sign.service';
import { ReactiveFormsModule } from '@angular/forms';
import { RouterModule, Routes  } from '@angular/router';
import { NavbarComponent } from './navbar/navbar.component';
import { LoginsService } from './logins.service';
import { CookieService } from 'ngx-cookie-service';
import { AuthGuard } from './auth/auth.guard';
import { LogauthGuard } from './auth/logauth.guard';
import { ForgotComponent } from './forgot/forgot.component';
import { ResetComponent } from './reset/reset.component';
import { AdminComponent } from './admin/admin.component';





const appRoutes: Routes = [
  { path: 'http://localhost:4200', redirectTo: 'http://localhost:4200/login', pathMatch: 'full' },
  { path: 'forgot' ,component:ForgotComponent},
  { path:'resetpassword/:code', component:ResetComponent },
  { path: 'login' , component:LoginComponent , canActivate:[LogauthGuard]},
  { path: 'signup', component: SignupComponent,canActivate:[LogauthGuard] },

  { path: 'cardetails/:id/:type', component:CardetailsComponent,
  canActivate:[AuthGuard]},
  
  {path: 'employee/:id/:type', component: EmployeeComponent, canActivate:[AuthGuard]}
];


  
@NgModule({
  declarations: [
    AppComponent,
    HeroesComponent,
    SignupComponent,
    LoginComponent,
    CardetailsComponent,
    EmployeeComponent,
    NavbarComponent,
    ForgotComponent,
    ResetComponent,
    AdminComponent,
    
   
  
  
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule.forRoot(appRoutes)
    
  ],
  providers: [
    DetailsService,
    CarService,EmpService,
    SignService,LoginsService,CookieService,AuthGuard,
  LogauthGuard],
  bootstrap: [AppComponent]
})
export class AppModule { }
