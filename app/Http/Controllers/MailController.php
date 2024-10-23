<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Mail;
use App\Mail\ForgetPassMail;
use App\Mail\RegisterMail;
  
class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $req)
    {
        try {
            $number = 1233342;
        
            $mailData = [  
                'body' => $number ,
                'name' => $req->name
            ];
            $mail = new ForgetPassMail($mailData);

            Mail::to($req->email)->send($mail);
            
        
            return response()->json([ 
                'status'=> 200,
                'message'=>'Gửi mail thành công !!!',
                'mail'=> $req->email
            ]); 
        } catch (\Throwable $th) {
            return response()->json([ 
                'status'=> 400,
                'message'=>'Có gì đó sai sai !!!'
            ]);
        }
    }
    public function register(Request $req)
    {
        try {
            $number = 1233342;
        
            $mailData = [  
                'body' => $number, 
            ];
            $mail = new RegisterMail($mailData);

            Mail::to($req->email)->send($mail);
            
        
            return response()->json([ 
                'status'=> 200,
                'message'=>'Gửi mail thành công !!!',
                'mail'=> $req->email
            ]); 
        } catch (\Throwable $th) {
            return response()->json([ 
                'status'=> 400,
                'message'=>'Lỗi !!!'
            ]);
        }
    }
}