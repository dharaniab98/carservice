<?php

//use App\Services\DataService;
//use Phalcon\Http\Response as response;
//use Phalcon\Http\Request as Request;
//include '../allapi/DataServie.php';
class UserController extends ControllerBase
{


    
    public function indexAction()
    {
        echo "hello";
          $ser=new DataService();
     $ser->hello();
////       echo("hii");
     exit();
//      // $req=request;
//        
//       // print_r($this->request->getHeaders());
//        //exit();
//        $this->response->setHeader('Access-Control-Allow-Origin', '*');
//        $this->response->setContentType("application/json, charset=UTF-8");
//         $this->response->setJsonContent(
//               [
//                  "status"
//               ]
//
//           );
//           return  $this->response->send();
        $this->userExistence("dharani@gmail.com");
 
    
    }
    
    
    
    public function editAction()
    {
          $response = new \Phalcon\Http\Response();
      $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setContentType("application/json, charset=UTF-8");
//         $response.setHeader("Access-Control-Allow-Origin", "*");
    //$response.setHeader("Access-Control-Allow-Credentials", "true");
  //  $response.setHeader("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
   // $response.setHeader("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
       // echo($this->request->isPost());
       // echo "hello";
       // echo($this->request->isGet());
      $val= $this->request->getJsonRawBody();
      $email=$val[0]->id;
      $check=$this->userExistence($email);
       //$request=new Request();
     // $this->request->get('id')
      
     if($check==0)
     {
         $response->setJsonContent([  "status"=>"invalid Email"]);
     }
     else
     {
         $res=$this->mail(sha1($email).uniqid());
         $response->setJsonContent([  "status"=>$res]);
         
     }
         
      return  $response->send();
//       // echo $val;
       // echo "hello";
    }
    
    
    public function mail($unid)
    {
                   $mail = new PHPMailer;
                    //Tell PHPMailer to use SMTP
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
                    $mail->addAddress('dharani.kumar@edureka.co', 'kumar');
                    //Set the subject line
                    $mail->Subject = 'Reset link';
                    //Read an HTML message body from an external file, convert referenced images to embedded,
                    //convert HTML into a basic plain-text alternative body
                    $mail->msgHTML($unid);//file_get_contents('contents.html'), __DIR__);
                    //Replace the plain text body with one created manually
                    $mail->AltBody = 'This is a plain-text message body';
                    //Attach an image file
                   // $mail->addAttachment('images/phpmailer_mini.png');
                    //send the message, check for errors
                    if (!$mail->send()) {
                        //echo "Mailer Error: " . $mail->ErrorInfo;
                          return "error in sending Mail";        
                    } else {
                        return "Reset Link sent";
                       
                   }
    }
     public function userExistence($email)
    {
        $user= Users::find(['conditions'=>'email="'.$email.'"','columns'=>'COUNT(*) as count']);
         return $user[0]->count;
    }
    
    
    public function resetAction()
    {
         $response = new \Phalcon\Http\Response();
         $response->setHeader('Access-Control-Allow-Origin', '*');
         $response->setContentType("application/json, charset=UTF-8");
         $val= $this->request->getJsonRawBody();
         $email=$val[0]->id;
          $response->setJsonContent([  "status"=> sha1($email)]);
          
          return  $response->send();
       
    }
        
    
}

