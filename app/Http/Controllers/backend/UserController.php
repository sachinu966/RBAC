<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use App\Models\Error;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get(); // Fetch users with associated role
        return view('backend.user.view_user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        return view('backend.user.create_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            // Create the user
           $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->roles()->attach($request->role_id);

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (Exception $ex) {
            Error::create([
                'url' => URL::current(),
                'message' => $ex->getMessage(),
            ]);

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editUser = User::findOrFail(decrypt($id));
        $roles = Role::all(); // Fetch all roles
        return view('backend.user.create_user', compact('editUser', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . decrypt($id),
        'password' => 'nullable|string|min:8|confirmed',
        'role_id' => 'required|exists:roles,id',
    ]);

    try {
        $user = User::findOrFail(decrypt($id));

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Update roles
        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    } catch (Exception $ex) {
        // Log the error
        Error::create([
            'url' => URL::current(),
            'message' => $ex->getMessage(),
        ]);

        return redirect()->route('users.index')->with('error', 'An unexpected error occurred. Please try again later.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail(decrypt($id));
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (Exception $ex) {
            // Log the error
            Error::create([
                'url' => URL::current(),
                'message' => $ex->getMessage(),
            ]);

            return redirect()->route('users.index')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function profile()
{
    return view('backend.user.profile');
}
}
