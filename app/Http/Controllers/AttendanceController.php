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
    public function index()
    {
        $users = User::whereNot('role', User::ROLE_ADMIN)->get(['id', 'name']);

        return view('attendance', compact('users'));
    }

    public function getAttendances($date = null)
    {
        $attendances = null;
        // role based checking
        if (Auth::user()->role == User::ROLE_ADMIN):
            if (!$date) {
                $attendances = Attendance::with('user')->get();
            } else {
                $attendances = Attendance::where('date', $date)->with('user')->get();
            }
        else:
            if (!$date) {
                $attendances = Attendance::where('user_id', Auth::id())->with('user')->get();
            } else {
                $attendances = Attendance::where('user_id', Auth::id())->whereDate('date', $date)->with('user')->get();
            }
        endif;

        if (!$attendances) {
            return response()->json(['success' => false, 'message' => 'Attendance data not fetched.', 'data' => []]);
        }
        return response()->json(['success' => true, 'data' => $attendances], 200);
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
            return response()->json(['success' => false, 'message' => 'Failed to mark attendance, try again!']);
        }
        return response()->json(['success' => true, 'message' => 'Attendance marked successfully.'], 200);
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
