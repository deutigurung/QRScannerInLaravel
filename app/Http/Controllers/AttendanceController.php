<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $today = Carbon::today()->format('Y-m-d');
        $check_qrcode = User::where('qr_code',$request->get('code'))->first();
        if(is_null($check_qrcode)){
            return response(404);
        }
        $attendance = Attendance::where('user_id',$check_qrcode->id)->where('entry_date',$today)->first();
        if($attendance->check_in != null && $attendance->check_out == null){
           return $this->updateAttendance($attendance);
        }
        if($attendance){
            return response(500);
        }
        $attendance = Attendance::create([
            'user_id' => $check_qrcode->id,
            'check_in' => Carbon::now()->format('H:i:s'),
            'entry_date' => $today,
        ]);
        return response(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAttendance(Attendance $attendance)
    {
        $attendance->update([
            'check_out' => Carbon::now()->format('H:i:s')
        ]);
        return response(200);
    }

    public function update(Request $request, Attendance $attendance)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
