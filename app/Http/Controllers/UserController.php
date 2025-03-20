<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmployeeApprovedNotification;


class UserController extends Controller
{
    // Dashboard/Display all users using table
    public function index(){
        $users = User::all();
        return view("admin.dashboard", compact("users"));
    }

    // Display add/create user form
    public function create(){
        return view("admin.create");
    }

    // Save/Create employee
    public function save(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'user_type' => ['required', 'string'],
            'approved' => ['boolean'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->input('user_type'),
            'approved' => $request->has('approved') ? 1 : 0,
            'password' => Hash::make($request->password),
        ]);

        if ($user){
            session()->flash("success","User added successfully!");
            return redirect("admin/dashboard");
        } else {
            session()->flash("error","Failed to add user!");
            return redirect("admin/create");
        }
    }

    // Edit/Update employee
    public function edit_form($id){
        $user = User::findOrFail($id);
        return view("admin.update", compact("user"));
    }

    public function edit(Request $request, $id){

        // Find employee by ID
        $user = User::findOrFail($id);

        // Check the old approved status
        $isApproved = $user->approved;
        // Check if approved checkbox is checked
        $approved = $request->has('approved') ? 1 : 0;

        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',  Rule::unique('employees')->ignore($id)],
            'user_type' => ['string'],
            'approved' => ['boolean'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Update employee details
        $updated = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->input('user_type'),
            'approved' => $approved,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Send notification email if user is approved
        if ($isApproved == 0 && $approved == 1) {
            $customEmail = $request->input('custom_email'); // Get custom email from request
            $user->notify(new EmployeeApprovedNotification($customEmail));
        }

        // If update is successful
        if ($updated) {
            return redirect()->route('admin.dashboard')->with('success', 'User Updated Successfully!');
        }
        // If update fails
        else {
            return redirect()->back()->with('error', 'Failed to Update User. Please try again.');
        }
    }

    public function delete($id){
        $user = User::findOrFail($id)->delete();
        // If delete is successful
        if ($user){
            return redirect()->route('admin.dashboard')->with('success', 'User Deleted Successfully!');
        }
        // If delete fails
        else {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to delete User. Please try again.');
        }
    }
}
