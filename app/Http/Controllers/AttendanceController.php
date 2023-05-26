<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
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
            $attendances = Attendance::where('date', $date)->with('user')->get(['date', 'status']);
        }
        $attendances = Attendance::with('user')->get(['date', 'status']);

        // return view(compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $date = now()->format('d-m-Y');
        $attendance = array_merge($request->validated(), ['user_id' => Auth::id(), 'date' => $date]);
        $result = Attendance::create($attendance);
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
