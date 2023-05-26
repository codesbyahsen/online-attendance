<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($date = null)
    {
        $attendances = null;
        if (isset($date) && !empty($date)) {
            $attendances = Attendance::where('date', $date)->with('user')->get();
        }
        $attendances = Attendance::with('user')->get();
        $users = User::get(['id', 'name']);

        return view('attendance', compact('attendances', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $date = now()->format('Y-m-d');
        $attendance = array_merge($request->validated(), ['date' => $date]);
        $result = Attendance::updateOrCreate(
            ['user_id' => $attendance['user_id'], 'date' => $attendance['date']],
            $attendance
        );
        if (!$result) {
            return back('error', 'Failed to mark attendance, try again!');
        }
        return redirect()->route('attendances')->with('success', 'Attendance marked successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
