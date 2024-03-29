<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function myQrCode()
    {
        $check_user = User::find(auth()->id());
        return view('qrcode',compact('check_user'));
    }
    public function index($userId,$type)
    {
        if($type == 'department'){
            $check_user = Department::find($userId);
        }else{
            $check_user = User::find($userId);
        }
        return view('qrcode',compact('check_user'));
    }
}
