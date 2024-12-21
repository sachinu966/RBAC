<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;
use App\Models\Error;
use Illuminate\Support\Facades\URL;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();
        return view('backend.role.view_role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.role.create_role');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:1000',
        ]);
    
        try {
            // Create the role
            Role::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            // Redirect with success message
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (Exception $ex) {
            // Log the error
            Error::create([
                'url' => URL::current(),
                'message' => $ex->getMessage(),
            ]);
    
            // Redirect with error message
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id=decrypt($id);
        $editRole=Role::find($id);
        return view('backend.role.create_role',compact('editRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . decrypt($id),
            'description' => 'nullable|string',
        ]);
    
        try {
            $roleId = decrypt($id);
    
            $role = Role::find($roleId);
    
            if (!$role) {
                return redirect()->route('roles.index')->with('error', 'Role not found.');
            }
    
            $role->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } catch (Exception $ex) {
            // Log the error
            Error::create([
                'url' => URL::current(),
                'message' => $ex->getMessage(),
            ]);
            return redirect()->route('roles.index')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Decrypt the role ID
            $roleId = decrypt($id);
            $role = Role::find($roleId);
            if (!$role) {
                return redirect()->route('roles.index')->with('error', 'Role not found.');
            }
    
            $role->delete();
    
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $ex) {
            // Log the error
            Error::create([
                'url' => URL::current(),
                'message' => $ex->getMessage(),
            ]);
                return redirect()->route('roles.index')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    
}
