<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index($userId)
    {
        $user = User::find($userId);
        $department = Department::find(1);
        $check_user = $department->users()->find($user->id);
        return view('qrcode',compact('check_user'));
    }
}
