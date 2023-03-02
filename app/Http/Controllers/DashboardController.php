<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(){
        $users = User::with('departments')->paginate(25);
        return view('dashboard',compact('users'));
    }
}
