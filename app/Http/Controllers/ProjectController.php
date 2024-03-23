<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function createProject(Request $request){
         
        $request->validate([
            'name' => 'required',
            'manager_id' => 'required',
            'deadline' => 'required'
        ]);
         Project::create([
            'name' => $request->name,
            'manager_id' => $request->manager_id,
            'deadline' => $request->deadline

          ]); 
        
        return redirect()->route('dashboard')->with('status', 'Project Successfully created');
        
        
    }

    public function updateProjectForm($id){

        $project = Project::find($id);
        $developers = User::where('role_id', 3)->get();

        return view('updateProject', compact('project','developers'));
    }
    public function updateProject(Request $request){

       if(auth()->user()->role_id == 2){
        $request->validate([
            'developer_id' => 'required'
        ]);
        $project = Project::where('id', $request->project_id)->update([
            'developer_id' => $request->developer_id
          ]);
       }else{

            $request->validate([
                'last_update' => 'required',
                'completion_percentage' => 'required',
                'comment' => 'required',
            ]);

            $project = Project::where('id', $request->project_id)->update([
                'last_update' => $request->last_update,
                'completion_percentage' => $request->completion_percentage,
                'comment' => $request->comment,
            ]);

       }

       $project = Project::find($request->project_id);
    
       session()->flash('status', 'Project has been updated successfully');
       return view('projectDetails', compact('project'));
       
      

        
    }

    public function completeProject($id){
        Project::where('id', $id)->update([
            'status' => 1,
           
        ]);

       $project = Project::find($id);
    
       session()->flash('status', 'Project Status has been updated successfully');
       return view('projectDetails', compact('project'));


    }


    public function deleteProject(Request $request){

        DB::table('projects')->where('id', $request->project_id)->delete();
        return redirect()->route('dashboard')->with('status', 'Project has been deleted successfully');

    }

    public function projectDetails($id){
        $project = Project::find($id);
       
        return view('projectDetails', compact('project'));
    }
}
