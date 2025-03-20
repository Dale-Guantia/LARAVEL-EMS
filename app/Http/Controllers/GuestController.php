<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class GuestController extends Controller
{
    public function index(){
        $employees = Employee::all();
        return view("guest.dashboard", compact("employees"));
    }
}
