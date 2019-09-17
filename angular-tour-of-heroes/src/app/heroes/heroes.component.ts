import { Component, OnInit } from '@angular/core';
import { DetailsService  } from '../details.service';
import { Hero } from '../hero';
@Component({
  selector: 'app-heroes',
   templateUrl: './heroes.component.html',

  styleUrls: ['./heroes.component.css']
})
export class HeroesComponent implements OnInit {

 public  hero=[];
  
  
  constructor(private detailService:DetailsService ) {
    this.detailService.getdetails().subscribe(xyz => 
      // console.log(data[0].id);
      {this.hero=xyz;
      //console.log(this.hero);
     console.log(this.hero[0][0].name);
      });
   }

  ngOnInit() {
    
  }

}
