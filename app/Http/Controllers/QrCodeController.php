<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index($userId)
    {
        $check_user = User::find($userId);
        return view('qrcode',compact('check_user'));
    }
}
