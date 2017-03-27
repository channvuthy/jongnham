<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function html_email(Request $request){
      $this->validate($request,[
           'name'=>'required|min:3',
           'message'=>'required',
           'email'=>'required|email'      
      ]);
      $to = "info@jongnhams.com";
      $subject = "User Contact";

      $message = "
      <html>
      <head>
      <title>Jongnhams.com-Please Confirmation Email!</title>
      </head>
      <body>
      <h1>Contact Information</h1>
      <strong>Name </strong>
      <p>".$request->name."</p>
      <strong>Message</strong>
      <p>".$request->message."</p>
      </body>
      </html>
      ";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // More headers
      $headers .= 'From: <'.$request->email.'>' . "\r\n";
      if(mail($to,$subject,$message,$headers)){
      	$request->session()->flash('message', 'Message was successful!');
         return redirect()->route('home.version2.index');
      }
      
   }
}
?>
