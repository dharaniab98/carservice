<?php


//use Phalcon\Http\Response as response;
//use Phalcon\Http\Request as request;
class IndexController extends ControllerBase
{

    
    public function indexAction()
    {
         //
         echo 'asda';
       
//         $ser=new PHPMailer();
//       
//         $ser->hello();
         exit();
//       echo("hii");
//       exit();
      // $req=request;
        
       // print_r($this->request->getHeaders());
        //exit();
//        $this->response->setHeader('Access-Control-Allow-Origin', '*');
//        $this->response->setContentType("application/json, charset=UTF-8");
//         $this->response->setJsonContent(
//               [
//                  "status"
//               ]
//
//           );
//           return  $this->response->send();
// 
    
    }
     //Action to get the engineering guys capacity
       public function engCapacity()
       {
          $val=Users::find(['conditions'=>"type LIKE 'eng'",'columns' => 'id, capacity']);
         $arr=array();
         foreach($val as $dat )
         {
             $arr[$dat->id]=$dat->capacity;
         }
         //print_r($arr);
         return $arr;
       }

       //action that give data about the washer man capacity
       public function washCapacity()
       {
          $val=Users::find(['conditions'=>"type LIKE 'wash'",'columns' => 'id, capacity']);
          
         $arr=array();
         foreach($val as $dat )
         {
             $arr[$dat->id]=$dat->capacity;
         }
          
         return $arr;
         
       }

       //Action that resturns basic service cost
       public function basicServiceCostAction()
       {
          $val=ServicesAvailable::find(['columns' => 'SUM(basic_service_cost) as sum']);
          //echo $val[0]->sum;
          return $val[0]->sum;
       }
       
       
       //Action to insert Addusers from signup page 

       public function insertUserAction($name,$phone,$email,$password)
       {
           
           
           
           $response = new \Phalcon\Http\Response();
           $response->setHeader('Access-Control-Allow-Origin', '*');
           $response->setContentType("application/json, charset=UTF-8");
           $val=$this->userExistence($email);
           if($val==0)
           {
           //echo "inser car data";
                        $d = new DateTime();
                        $user=new Users();
                        $user->name=$this->filter->sanitize($name,[ 'striptags','trim','string' ]);
                        $user->phone=$this->filter->sanitize($phone,[ 'striptags','trim','string' ]);
                        $user->email=$this->filter->sanitize($email ,[ 'email' ]);
                        $user->password=sha1($password);
                        $user->type="cust";
                        $user->capacity=0;
                        $user->cr_date=$d->format("Y-m-d H:i:s");
                        $user->save();
                        $response->setJsonContent(["status"=>"1"]); 
           }
           else
           {
              if($val==1) 
              {    
                   $response->setJsonContent(["status"=>"2"]);    
              }
              else
              {
                  $response->setJsonContent(["status"=>"3"]);  
              }
           }
           return  $response->send();


       }

       
       //checking for user existence
       
            public function userExistence($email)
            {
                $user= Users::find(['conditions'=>'email="'.$email.'"','columns'=>'COUNT(*) as count']);
                 return $user[0]->count;
            }

        // checkiing the user login
            public function userLoginAction($email,$password)
            {
                $this->response->setHeader('Access-Control-Allow-Origin', '*');
                $this->response->setContentType("application/json, charset=UTF-8");     
                $user= Users::find(['conditions'=>'email="'.$email.'" ','columns'=>'COUNT(*) as count,id,type,password']);
              //  echo $user[0]->password;
                echo $user[0]->id;
              //  echo sha1($password);
               // exit();
                
                if($user[0]->count !=0 && $user[0]->id != 0)
                {
                    if($user[0]->password==sha1($password))
                    {
                        
                       $this->response->setJsonContent(["status"=>"valid","user_id"=>$user[0]->id,"type"=>$user[0]->type]); 
                    }
                    else{
                       $this->response->setJsonContent(["status"=>"invalidpass","user_id"=>0]); 
                     }
                 }
                 else{
                       $this->response->setJsonContent(["status"=>"invalid","user_id"=>0]); 
                 }
                 return $this->response->send();       
            }
           
            
    
    



       // this action is used to inser the car details
       public function insertCarDataAction($license,$chesis,$battery,$make,$model,$color,$fuel,$body,$complaint,$owner_id){
           $response = new \Phalcon\Http\Response();
           $response->setHeader('Access-Control-Allow-Origin', '*');
           
            
//       echo $det[eng_id];
//       echo $det[wash_id];
      if($this->carExistenceAction($license) == 0)
      {
          
          $det=$this->employeeAllocation();
        if(($det[eng_id] !=-1)&&($det[wash_id] != -1))
        {
           $d = new DateTime();
           //2016-07-04T17:53:30+02:00echo $d;
          // "Y-m-d H:i:s", $datetime

           $carData=new CarDetails();
            $carData->car_license_number=$license;
            $carData->car_chesis_number=$chesis;
            $carData->car_battery_number=$battery;
            $carData->car_color=$color;
            $carData->car_model_name=$model;
            $carData->car_make=$make;
            $carData->car_fuel_level=$fuel;
            $carData->car_body_description=$body;
            $carData->user_complaints=$complaint;
            $carData->owner_id=$owner_id;
            $carData->car_cr_date=$d->format("Y-m-d H:i:s");
             $carData->save();

          $lastcar= CarDetails::find(['columns'=>'car_id','order' => 'car_id DESC','limit'=>1]);
          $car_id=$lastcar[0]->car_id;
           $this->insertOrderAction($det[eng_id], $det[wash_id], $car_id);
           $response->setContentType("application/json, charset=UTF-8");
           $response->setJsonContent([ "status"=>"valid",]);
           
        }
        else
        {
            $response->setJsonContent( [ "status"=>"invalid",]);

      
        }
      }
      else
      {
          $response->setJsonContent( [ "status"=>"Car already in service",]);
      }
           //echo json_encode($val);
           return  $response->send();
           

   }


       //function to insert in  new serviceorderdetails after fillimg the car_details inserrt a row in serviceorderdetails


        public function insertOrderAction($engid,$washid,$carid)
        {
            $d = new DateTime();
            $order=new ServiceOrderDetails();
            $order->eng_id=$engid;
            $order->wash_id=$washid;
            $order->car_id=$carid;
            $order->md_date=$d->format("Y-m-d H:i:s");
            $order->cr_date=$d->format("Y-m-d H:i:s");
            $order->save();
           echo ("done");
        }
        
        public function carExistenceAction($license)
        {
            
            $d = new DateTime();
            $date= $d->format("Y-m-d");
            $car= CarDetails::find(['conditions'=>'car_license_number="'.$license.'" AND car_cr_date like "%'.$date.'%"','columns'=>'count(*) as count']) ; 
            return $car[0]->count;
         }
        
      //used to display the engineer works and washer man work details from service orderdetails

        public function getOrdersAction($id,$type)
        {
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Access-Control-Allow-Origin', '*');

                 $d = new DateTime();
               $dat= $d->format("Y-m-d");
                

                 if($type=="eng") {
                   //  echo($dat);
                   //  $val = ServiceOrderDetails::find(['conditions' => 'eng_id="'.$id.'" AND cr_date like "%'.$dat.'%" AND status=0','columns'=>'order_id,car_id,eng_extra_cost,remarks,status']);
                   // $val = ServiceOrderDetails::find(['conditions' => 'eng_id='.$id.'','columns'=>'order_id,car_id']);
                    $val=$this->getEngOrderDataAction($id);
                   // echo json_encode($val);
                    $response->setJsonContent($val);
                }
                else{
                   // $val = ServiceOrderDetails::find(['conditions' => 'wash_id="'.$id.'" AND cr_date like "%'.$dat.'%" AND status > 0 AND status< 7','columns'=>'order_id,car_id,eng_extra_cost,remarks,status']);
                    $val=$this->getWashOrderDataAction($id);
                    //echo json_encode($val);
                    $response->setJsonContent($val);
                    
                }

            $response->setContentType("application/json, charset=UTF-8");
            
               return  $response->send();

          //  echo json_encode($val);

        }

        //function to update the the service order details .........
        public function updateOrderAction($order_id,$car_id,$extra_cost,$remarks,$status)
        {
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Access-Control-Allow-Origin', '*');
             $response->setContentType("application/json, charset=UTF-8");

             $update=ServiceOrderDetails::findFirst(['conditions'=>'order_id='.$order_id.'']);
             $update->remarks=$update->remarks.$remarks;
             $update->status=$update->status+$status;
             if($status==1)
             {
                 $update->eng_extra_cost=$extra_cost;
                 $response->setJsonContent( ["status"=>"Engineering Work Done"] );
             }
             else if($status > 1 && $status < 4)
             {
                 $update->wash_extra_cost=$extra_cost;
                  $response->setJsonContent( ["status"=>"interir Cleaning"] );
             }
             else
             {
                $res= $this->mailCustAction($order_id);
                 $response->setJsonContent( ["status"=>$res] );
             }
             $update->save();

           
            

            //echo json_encode($val);
            return  $response->send();


            //echo json_encode($update);
        }


//      public function employeecheckAction()
//      {
//          $lastcar= CarDetails::find(['columns'=>'car_id','order' => 'car_id DESC','limit'=>1]);
//          echo $lastcar[0]->car_id;
////          $det=$this->employeeAllocationAction();
////       echo $det[eng_id];
////       echo $det[wash_id];
//      }
//      
         
        
        // method to give the employees in roundrobin order ...........
        public function employeeAllocation()
        {
            
           $lastemp= ServiceOrderDetails::find(['columns'=>'eng_id,wash_id','order' => 'order_id DESC','limit'=>1]);
           //echo($lastemp[0]->eng_id);
           //echo($lastemp[0]->wash_id);
        //   print_r($lastemp);
           //  static $i=0;
                      
                     // print_r($arr);
           $eng=$this->engAllocation($lastemp[0]->eng_id);
          // echo "eng ".$eng;
           $wash=$this->washAllocation($lastemp[0]->wash_id);
          // echo $wash;
           return ["eng_id"=>$eng,'wash_id'=>$wash];
          
        }
        
        //method to give the engneering employee in round robin order 
        public function engAllocation($eng_id)
        {
             $d = new DateTime();
               $date= $d->format("Y-m-d");
           // echo($eng_id);
            
            $arr=$this->engCapacity();
           // print_r($arr);
            $i=0;
            $count=count($arr);
            $eid=array_keys($arr);
            
            
           // echo $count;
            foreach($eid as $dat)
            {
                $i++;
               if($dat==$eng_id)
               {
                 break;
               }
               
            }
          //echo  "i ".$i;
         // print_r($arr);
           // return $eng_id;
          $lcount=0;
                while(TRUE)
                {
                    $lcount=$lcount+1;
                    if($lcount==$count)
                    {
                        return -1;
                    }
                    if($i >= $count)
                    {
                        $i=$i%$count;
                    }
                    $current=$eid[$i];
                  //  echo "currnet".$current;
                    
                    //$id=key($current);
                   // echo($arr[$i][$id]);
                    $cap=ServiceOrderDetails::find(['conditions' => 'eng_id="'.$current.'" AND  cr_date like "%'.$date.'%"','columns'=>'COUNT(*) as capacity']);
                 // print_r($cap); 
              // echo  "capa ".$cap[0]->capacity;  
                    if($arr[$current]==$cap[0]->capacity)
                    {
                        $i=($i+1);
                        $i=($i%$count);

                    }
                    else {
                       
                        return $current;
                    }

                } 
            
            return 0;
        }
        
        //method to give the  wash employee in round robin order 
        
        public function washAllocation($wash_id)
        {
                  $d = new DateTime();
               $date= $d->format("Y-m-d");
           // echo($eng_id);
            
            $arr=$this->washCapacity();
            print_r($arr);
            $i=0;
            $count=count($arr);
            $eid=array_keys($arr);
            
            
            echo $count;
            foreach($eid as $dat)
            {
                $i++;
               if($dat==$wash_id)
               {
                 break;
               }
               
            }
          //echo  "i ".$i;
         // print_r($arr);
           // return $eng_id;
          $lcount=0;
                while(TRUE)
                {
                    $lcount=$lcount+1;
                    if($lcount==$count)
                    {
                        return -1;
                    }
                    if($i >= $count)
                    {
                        $i=$i%$count;
                    }
                    $current=$eid[$i];
                  //  echo "currnet".$current;
                    
                    //$id=key($current);
                   // echo($arr[$i][$id]);
                    $cap=ServiceOrderDetails::find(['conditions' => 'wash_id="'.$current.'" AND  cr_date like "%'.$date.'%"','columns'=>'COUNT(*) as capacity']);
                 // print_r($cap); 
              // echo  "capa ".$cap[0]->capacity;  
                    if($arr[$current]==$cap[0]->capacity)
                    {
                        $i=($i+1);
                        $i=($i%$count);

                    }
                    else {
                       
                        return $current;
                    }

                } 
            
            return 0;
       
        }
        

    public function mailCustAction($id)
    {
            $resultset = $this->modelsManager->createBuilder()
          ->columns('Users.email')
          ->from('CarDetails')
          ->join('Users','Users.id=CarDetails.owner_id')
          ->join('ServiceOrderDetails', 'ServiceOrderDetails.car_id=CarDetails.car_id')
           ->where('ServiceOrderDetails.order_id="'.$id.'"')
          ->getQuery()
          ->execute();
           $email=$resultset[0]->email;
            $basicCost=$this->basicServiceCostAction();  
            $extraCost=$this->extraCostAction($id);
            $totalCost=$basicCost+$extraCost;
            $this->finalMailAction($email,$totalCost);
            return $email;
            
      
    }
    
    public function finalMailAction($email,$totalCost)
    {
                    $mail = new PHPMailer;
                    $mail->isMail();
                   
                    //Username to use for SMTP authentication - use full email address for gmail
                    $mail->Username = "dharaniab98@gmail.com";
                    //Password to use for SMTP authentication
                    $mail->Password = "dharaniab";
                    //Set who the message is to be sent from
                    $mail->setFrom('from@carserivce.co', 'First Last');
                    //Set an alternative reply-to address
                    $mail->addReplyTo('replyto@example.com', 'First Last');
                    //Set who the message is to be sent to
                    $mail->addAddress($email, 'hiii');
                    //Set the subject line
                    $mail->Subject = 'Car Cleaners Final Amount';
                    //Read an HTML message body from an external file, convert referenced images to embedded,
                    //convert HTML into a basic plain-text alternative body
                    $mail->msgHTML("Total cost".$totalCost);//file_get_contents('contents.html'), __DIR__);
                    //Replace the plain text body with one created manually
                    $mail->AltBody = 'This is a plain-text message body';
                    //Attach an image file
                   // $mail->addAttachment('images/phpmailer_mini.png');
                    //send the message, check for errors
                    if (!$mail->send()) {
                        //echo "Mailer Error: " . $mail->ErrorInfo;
                          return "error in sending Mail";        
                    } else {
                        return "Mail sent";
                       
                   }
    }
    public function extraCostAction($id)
    {
        //$update=ServiceOrderDetails::findFirst(['conditions'=>'order_id='.$id.'']);
    
       $update=ServiceOrderDetails::findFirst(['conditions'=>'order_id="'.$id.'"']);
        $extra_cost= $update->eng_extra_cost  + $update->wash_extra_cost;
        return  $extra_cost;
        
    }
//        
        
        
        
        
        
    //
//   public function respon($res)
//    {
//        $response = new \Phalcon\Http\Response();
//        $response->setHeader('Access-Control-Allow-Origin', '*');
//        $response->setContentType("application/json, charset=UTF-8");
//            $response->setJsonContent(
//                [
//                    $res
//               ]
//            );
//         echo json_encode($val);
//         return  $response->send();
//
//        
//    }

    public function userDataAction($name,$id)
    {
      
               $response = new \Phalcon\Http\Response();
               $response->setHeader('Access-Control-Allow-Origin', '*');
               $val=Users::find(['columns' => 'id,name']);
             //  $response->setStatusCode(200, "OK");
            //   $response->setContent("<html><body>Hello</body></html>");
           $response->setContentType("application/json, charset=UTF-8");
            $response->setJsonContent(
               [
                      $val
               ]
                  
            );
               //echo json_encode($val);
               return  $response->send($val);
               
      //$val=Users::find(['columns' => 'type,COUNT(*)','group' => 'type']);
     // $val=Users::find(['columns' => 'id,name']);
     // echo json_encode($val);
    }
    public function serviceDataAction()
    {
      $result=ServicesAvailable::find();
      echo json_encode($result);
    }
    public function insertServiceAction()
    {
         $ser=new ServicesAvailable();
         $ser->service_id=4;
         $ser->service_name='service4';
         $ser->basic_service_cost=300; 
          $ser->save();
         $result=ServicesAvailable::find();
         echo json_encode($result);
         
    }

    
    public function getEngOrderDataAction($id)
    {
         $d = new DateTime();
         $dat= $d->format("Y-m-d");
         $resultset = $this->modelsManager->createBuilder()
          ->columns('order_id,ServiceOrderDetails.car_id,eng_extra_cost,remarks,status,CarDetails.car_license_number')
          ->from('CarDetails')
          ->join('ServiceOrderDetails', 'ServiceOrderDetails.car_id=CarDetails.car_id')
           ->where('ServiceOrderDetails.eng_id="'.$id.'" AND ServiceOrderDetails.cr_date like "%'.$dat.'%" AND ServiceOrderDetails.status=0')
          ->getQuery()
          ->execute();
        // echo json_encode($resultset);
          return $resultset;
    }
     
    public function getWashOrderDataAction($id)
    {
        $d = new DateTime();
         $dat= $d->format("Y-m-d");
         $resultset = $this->modelsManager->createBuilder()
          ->columns('order_id,ServiceOrderDetails.car_id,eng_extra_cost,remarks,status,CarDetails.car_license_number')
          ->from('CarDetails')
          ->join('ServiceOrderDetails', 'ServiceOrderDetails.car_id=CarDetails.car_id')
           ->where('ServiceOrderDetails.wash_id="'.$id.'" AND ServiceOrderDetails.cr_date like "%'.$dat.'%" AND ServiceOrderDetails.status > 0 AND ServiceOrderDetails.status < 7')
          ->getQuery()
          ->execute();
           return $resultset;
    }
    
    
    
    public function adminAction()
    {
         $d = new DateTime();
         $dat= $d->format("Y-m-d");
         $resultset = $this->modelsManager->createBuilder()
          ->columns('CarDetails.car_id,car_license_number,car_chesis_number,car_battery_number,car_model_name,car_make,car_fuel_level,car_body_description,user_complaints,owner_id,car_cr_date')
          ->from('CarDetails')
          ->join('ServiceOrderDetails', 'ServiceOrderDetails.car_id = CarDetails.car_id')
           ->where('CarDetails.car_cr_date like "%'.$dat.'%" AND ServiceOrderDetails.car_id != CarDetails.car_id')
          ->getQuery()
          ->execute();
         echo json_encode($resultset);
          // return $resultset;
    }
    
    
    
    public function filterAction()
    {
        $hello=$this->filter->sanitize("helloo<<<<<",[
        'striptags',
        'trim',
         'string'
    ]);
        echo $hello;
    }
    

}


//create table forgot(
//     id int(10) primary key AUTO_INCREMENT,
//     gmail varchar2(250),
//     encode varchar2(250),
//     status int default 0,   
//     md_date DATETIME,
//     cr_date DATETIME   
//     )ENGINE = InnoDB AUTO_INCREMENT=1;




// create table service_order_details (
//   order_id int(10) primary key AUTO_INCREMENT,
//   eng_extra_cost int default 0,
//   wash_extra_cost int default 0,
//   remarks text,
//   status int default 0,
//   eng_id int(10)  NOT NULL REFERENCES users(id),
//   wash_id int(10)  NOT NULL REFERENCES users(id),
//   car_id int(10)  NOT NULL REFERENCES car_details(car_id),
//   md_date DATETIME,
//   cr_date DATETIME
//   )ENGINE = InnoDB AUTO_INCREMENT=1;
// car_id               | int(10)      | NO   | PRI | NULL    | auto_increment |
// | car_license_number   | varchar(100) | NO   |     | NULL    |                |
// | car_chesis_number    | varchar(100) | NO   |     | NULL    |                |
// | car_battery_number   | varchar(100) | NO   |     | NULL    |                |
// | car_color            | varchar(100) | NO   |     | NULL    |                |
// | car_model_name       | varchar(100) | NO   |     | NULL    |                |
// | car_make             | varchar(100) | NO   |     | NULL    |                |
// | password             | varchar(50)  | NO   |     | NULL    |                |
// | car_fuel_level       | int(11)      | NO   |     | NULL    |                |
// | car_body_description | text         | YES  |     | NULL    |                |
// | user_complaints      | text         | YES  |     | NULL    |                |
// | owner_id             | int(10)      | NO   |     | NULL    |                |
// | car_cr_date          | datetime     | YES  |     | NULL    |   

// insert into service_order_details(remarks,eng_id,wash_id,car_id,md_date,cr_date)values("nothing",10006,10013,1,now(),now());



// insert into car_details(car_license_number,car_chesis_number,car_battery_number,car_color,car_model_name,car_make,car_fuel_level,car_body_description,user_complaints,owner_id,car_cr_date)values ('1234','3444dded','aawf34','red','i20','tata',10,'scrach at back','break problem',10002,now())
//http://www.dharani.com/dharani/index/insertCarData/Ap2133/23444/bt450/red/tata/i20/3/nothhig/break*/