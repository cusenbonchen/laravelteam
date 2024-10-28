<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassMail;
use App\Mail\RegisterMail;

class AuthController extends Controller
{
    
    public function loginView(){
        $user = Session::get('user'); 
        if($user){
            return redirect('/');
        }else{
            return view("login");
        }
        
    }
    public function login(Request $request){  
       Lang::setLocale($request->language);
       try { 
            
            $passWordNotMatch = Lang::get('auth.passWordNotMatch');
            $isLogin = Lang::get('auth.isLogin');
            $username = $request->username;   
            $userExist = User::where('username', $username)->first();  
            if ($userExist) {  
                if(Hash::check($request->password, $userExist->password)){

                    if($userExist->email_verified != 1){
                        return view('login')->with('message', 'Vui lòng kích hoạt mail trước khi sử dụng tài khoản!!!');
                    }

                    Session::put('user', $userExist); 

                    return redirect('/');
                }else{
                    return view('login')->with('message', $passWordNotMatch);
                }
                
            } else {  
                return view('login')->with('message', $passWordNotMatch);
            }   
       } catch (\Throwable $th) {
            return view('404');
       }
    }
    public function forgotPass(Request $req){
        Lang::setLocale($req->language);  
        $sendMailSuccess = Lang::get('auth.sendMailSuccess');
        $emailNotFound = Lang::get('auth.emailNotFound');
        try {
            $email = User::firstWhere('email', $req->email);  
            if(!$email) 
                return view('forgotPassword')->with('message', $emailNotFound); 
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $token = substr(str_shuffle($characters), 0, 30);
            $result = $email->update([
                "token_email" => $token, 
            ]);  
           
            if($result){   
                $mailData = [  
                    'body' => $token,
                    'id'=> $email->id,
                    'lastname' => $email->lastname
                ];      
                $mail = new ForgetPassMail($mailData);  
                Mail::to($req->email)->send($mail); 
                return view('forgotPassword')->with('message', 'Gửi thư thành công!!! Vui lòng kiểm tra hộp thư hoặc spam.');
            }
            
        
        } catch (\Throwable $e) {   
            return view('forgotPassword')->with('message', $e);
        }
    }
    public function forgot(){ 
       return view("forgotPassword"); 
    }

    public function registerView(){ 
        return view("Register"); 
    }
    public function ChangePassView(){ 
        return view("ChangePass"); 
    }
    public function emailverifiedView(){ 
        return view("emailverified"); 
    }
    public function emailverified(Request $request){ 
        $user = User::firstWhere('id', $request->id);
        $wrongToken = Lang::get('auth.wrongToken'); 
        $successGetNewPass = Lang::get('auth.successGetNewPass');
        $rePasswordNotMatch = Lang::get('auth.rePasswordNotMatch'); 
        if($user){ 
            if(hash_equals($user->token_email, $request->token_email)){
                
                $result = $user->update([
                    "token_email" => '',
                    "email_verified" => true
                ]); 
                if($result){   
                    return view("login")->with('message', 'Xác nhận mail thành công!!!'); 
                } 
            }
        }


       
    }
    public function ChangePass(Request $request){ 
        Lang::setLocale($request->language); 
        $user = User::firstWhere('id', $request->id);
        $wrongToken = Lang::get('auth.wrongToken'); 
        $successGetNewPass = Lang::get('auth.successGetNewPass');
        $rePasswordNotMatch = Lang::get('auth.rePasswordNotMatch'); 
        if($user){ 
            if(hash_equals($user->token_email, $request->token_email)){
                
                if($request->password !== $request->rePassword)
                    return view('ChangePass')->with('message', $rePasswordNotMatch);
                $result = $user->update([
                    "token_email" => '',
                    "password" => Hash::make($request->password)
                ]); 
                  
                if($result){   
                    return view('login')->with('message', $successGetNewPass);
                } 
               
            }else{
                $dataMail = [
                    'text' => $wrongToken,
                    'email' => $request->email
                ];
                return view('login')->with('message', 'Lấy lại mật khẩu thành công !!!');
            }
        }
    }


    public function register(Request $request){ 
        Lang::setLocale($request->language);   
        try {
            $registerSuccess = Lang::get('auth.registerSuccess');
            $emaiExit = Lang::get('auth.emaiExit');
            $userExit = Lang::get('auth.userExit');
            $rePasswordNotMatch = Lang::get('auth.rePasswordNotMatch');
            $username = User::firstWhere('username', $request->username); 
            $email = User::firstWhere('email', $request->email); 

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $token = substr(str_shuffle($characters), 0, 30); 

            if($email)
                return view('Register')->with('message', $emaiExit);
            if($username)
                return view('Register')->with('message', $userExit);
            if($request->password !== $request->rePassword)
                return view('Register')->with('message', $rePasswordNotMatch);
            $data = [
                'username' => $request -> username,
                'email' => $request -> email,
                'first_name' => $request -> first_name,
                'last_name' => $request -> last_name,
                'password' => Hash::make($request->password),
                "token_email" => $token, 
            ];
            $result = User::create($data);
           
            if($result){   
                $mailData = [  
                    'body' => $token,
                    'id'=> $result->id,
                    'lastname' => $result->lastname
                ];
     
                $mail = new RegisterMail($mailData);  
                Mail::to($request->email)->send($mail); 
                return view('login')->with('message', 'Tài khoản được tạo thành công !!! Vui lòng kich hoạt mail để tiếp tục sử dụng');
            }

            
        } catch (\Throwable $e) {
            return view('Register')->with('message', $e);
        }

    }
    public function logout(){
        try {
            $user = Session::get('user');
            if($user){
                Session::forget('user');
            }
            return view("login");
        } catch (\Throwable $th) {
           return view('/404');
        }
    } 
}
