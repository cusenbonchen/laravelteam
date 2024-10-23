<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use App\Models\Project; 
use App\Models\User;

class UserController extends Controller
{
    public function getProjectByUserId(Request $request){ 
        
        try {
            $user = User::findOrFail($request->id); 
            $arr = json_decode($user->projects, true);   
           
            $projects = Project::whereIn('id', $arr)->get();
            return $projects;
            return response()->json([
                'status' => 200,
                'users' => $projects,
            ]);
            // return view('/HomePage',["projects"=>$projects]);
        } catch (\Throwable $th) {
            return view('404');
        }
    }
    public function HomePage(){ 
        return view('HomePage');
    }
    public function getAllUser() { 
       
        try {
            $users = User::get();
            return response()->json([
                'status' => 200,
                'users' => $users,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching users',
            ], 500);
        }
    }
}
