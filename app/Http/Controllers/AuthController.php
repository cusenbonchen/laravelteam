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
            $radom = $email->lastname;
            $token = random_int(1000000000, 9999999999);
            $result = $email->update([
                "token_email" => $token, 
            ]);  
            $mailData = [  
                'body' => $token,
                'id'=> $email->id,
                'lastname' => $email->lastname
            ];
            $dataMail = [
                'text' => $sendMailSuccess,
                'email' => $req->email
            ];
            if($result){   
                $mail = new ForgetPassMail($mailData);  
                Mail::to($req->email)->send($mail); 
                return view('ChangePass')->with('message', $dataMail);
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
    public function ChangePass(Request $request){ 
        Lang::setLocale($request->language); 
        $email = User::firstWhere('email', $request->email);
        $wrongToken = Lang::get('auth.wrongToken'); 
        $successGetNewPass = Lang::get('auth.successGetNewPass');
        $rePasswordNotMatch = Lang::get('auth.rePasswordNotMatch'); 
        if($email){ 
            if($email->token_email === $request->token_email){
                if($request->password !== $request->rePassword)
                    return view('Register')->with('message', $rePasswordNotMatch);
                $result = $email->update([
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
                return view('ChangePass')->with('message', $dataMail);
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
            ];
            User::create($data);
            return view('login')->with('message', $registerSuccess);
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
