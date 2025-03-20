<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // Dashboard/Display all employees using table
    public function index(){
        $employees = Employee::all();
        return view("employee/dashboard", compact("employees"));
    }

    // Display add/create employee form
    public function create(){
        return view("employee/create");
    }

    // Save/Create employee
    public function save(Request $request){
        $validation = $request->validate([
            "name"=> "required|string|max:255",
            "email"=> "required|email|lowercase|max:255|unique:employees,email",
            "phone"=> "required|regex:/^\+?[0-9]{10,15}$/",
            "position"=> "required|string|max:100",
            "salary"=> "required|numeric|min:0"
        ]);
        $employee = Employee::create($validation);
        if ($employee){
            session()->flash("success","Employee added successfully!");
            return redirect("employee/dashboard");
        } else {
            session()->flash("error","Failed to add employee!");
            return redirect("employee/create");
        }
    }

    // Edit/Update employee
    public function edit_form($id){
        $employee = Employee::findOrFail($id);
        return view("employee/update", compact("employee"));
    }

    public function edit(Request $request, $id){

        // Validate input
        $request->validate([
            "name"=> "required|string|max:255",
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',  Rule::unique('employees')->ignore($id)],
            "phone"=> "required|regex:/^\+?[0-9]{10,15}$/",
            "position"=> "required|string|max:100",
            "salary"=> "required|numeric|min:0"
        ]);

        // Find employee by ID
        $employee = Employee::findOrFail($id);

        // Update employee details
        $updated = $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        // If update is successful
        if ($updated) {
            return redirect()->route('employee.dashboard')->with('success', 'Employee Updated Successfully!');
        }
        // If update fails
        else {
            return redirect()->back()->with('error', 'Failed to Update Employee. Please try again.');
        }
    }

    public function delete($id){
        $employee = Employee::findOrFail($id)->delete();
        // If delete is successful
        if ($employee){
            return redirect()->route('employee.dashboard')->with('success', 'Employee Deleted Successfully!');
        }
        // If delete fails
        else {
            return redirect()->route('employee.dashboard')->with('error', 'Failed to delete Employee. Please try again.');
        }
    }
}
