<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function createRole(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        Role::create([
            'name' => $request->name,
          ]); 
        
        return redirect()->route('dashboard')->with('status', 'Role Successfully created');

    }

    public function deleteRole(Request $request){

        DB::table('roles')->where('id', $request->role_id)->delete();
        return redirect()->route('dashboard')->with('status', 'Role has been deleted successfully');

    }

}
