<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use App\Models\Error;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class RoleHasPermissionController extends Controller
{
     // Show the form for assigning permissions to the role
     public function index(){
        $roles=Role::all();
        $permissions=Permission::all();
        return view('backend.role.role_has_permission',compact('roles','permissions'));
     }
 
     // Update the permissions of the role
     public function update(Request $request)
     {
         try {
             // Iterate through each role and update its permissions
             foreach ($request->role_permissions as $roleId => $permissions) {
                 $role = Role::findOrFail($roleId);
                 // Sync the selected permissions with the role
                 $role->permissions()->sync($permissions);
             }
     
             return redirect()->route('role-has-permissions')->with('success', 'Permissions updated successfully.');
         } catch (Exception $ex) {
             // Handle the exception (log it and return an error response)
             Error::create([
                 'url' => URL::current(),
                 'message' => $ex->getMessage(),
             ]);
             return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
         }
     }
     
     
}
