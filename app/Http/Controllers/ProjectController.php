<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use App\Models\Project; 
use App\Models\User; 

class ProjectController extends Controller
{ 
    public function createProjectView(){ 
        return view("CreateProject"); 
    }
    public function updateProjectView(Request $request){ 
        $projectId = $request->id;
        $project = Project::findOrFail($projectId);
        return view("UpdateProjectView",["project"=>$project]);  
    }
    public function ProjectDetailView(){ 
        return view("ProjectDetail"); 
    }

    public function updateProject(Request $request){ 
        try { 
            $projectId = $request->id;
           
            $project = Project::findOrFail($projectId); 
            $project->update([
               "code" => $request -> code,
                "project_name" => $request -> project_name,
                "client" => $request -> client,
                "level" => $request -> level,
                "deadline" => $request -> deadline,
                "assign" => $request -> assign,
                "content" => $request -> content,
            ]);
            return redirect()->route('user.HomePage')->with('message', 'Update thành công !!!');
        } catch (\Throwable $e) {
            return view('404');
        }
      
    }
    public function projectDetail(Request $request){
        
        $projectId = $request->id;
        $project = Project::findOrFail($projectId);

        return $project;
    }
    public function createProject(Request $request){ 
        try {
            $project = Project::firstWhere('code', $request->code); 
            if($project)
                return view('CreateProject')->with('message', "Mã dự án đã tồn tại !!!");
            $data = [
                "code" => $request -> code,
                "project_name" => $request -> project_name,
                "client" => $request -> client,
                "level" => $request -> level,
                "deadline" => $request -> deadline,
                "assign" => $request -> assign,
                "content" => $request -> content
            ];
            $item = Project::create($data); 
            $arrUser = json_decode($request->assign, true);
            //Add to user
            $users = User::whereIn('id', $arrUser)->get();
            
            foreach ($users as $user) {
                $projects = json_decode($user->projects, true);
                
                if (is_array($projects)) {
                    $projects[] = $item->id;
                } else {
                    $projects = [$item->id];
                }
    
                $user->projects = json_encode($projects);
                $user->save();
            }
            
            return view('HomePage');

        } catch (\Throwable $e) {
            return view('CreateProject')->with('message', $e);
        }
    }
    public function updateProcess(Request $request){  
       try {
            $project = Project::findOrFail($request->id);
            $project->update([
                "process" => $request->process
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Update Success !!!',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Project not found.',
            ]);
        } catch (\Throwable $th) {
            return view('404');
        }
    } 

    public function findProjectByCode(Request $request){
       
        $projects = Project::where('code', 'LIKE', "%{$request->value}%")
        ->orWhere('project_name', 'LIKE', "%{$request->value}%")
        ->orWhere('client', 'LIKE', "%{$request->value}%")
        ->get();
        return response()->json([
            'status'=> 200,
            'results' => $projects 
        ]);
    }
}
