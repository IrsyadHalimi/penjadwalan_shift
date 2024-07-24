<?php

namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;
use App\Models\Department;
use App\Models\OperatorType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;


class OperatorScheduleController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Jadwal";
        $viewData["shift"] = Shift::whereIn('id', $shiftId)->get();
        return view('operator.schedule.index')->with("viewData", $viewData);
    }

    public function listSchedule(Request $request)
    {
        $departmentId = Auth::user()->department_id;
        $operatorTypeId = Auth::user()->operator_type_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $userId = User::where('operator_type_id', $operatorTypeId)->pluck('id')->toArray();

        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date = date('Y-m-d', strtotime($request->end));

        $schedule = Schedule::where('start_date', '>=', $start_date)
            ->where('end_date', '<=', $end_date)
            ->whereIn('shift_id', $shiftId)
            ->whereIn('user_id', $userId)
            ->get()
            ->map(function ($item) {
                $shift = Shift::find($item->shift_id);
                $user = User::find($item->user_id);
                $label_color = $shift ? ['bg-' . $shift->label_color] : [];
                $user_label_name = $user ? [$user->full_name] : [];

                return [
                    'id' => $item->id,
                    'user_id' => $item->user_id,
                    'title' => $user_label_name,
                    'start' => $item->start_date,
                    'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                    'shift_id' => $item->shift_id,
                    'className' => $label_color,
                ];
            });

        return response()->json($schedule);
    }

    public function edit(Schedule $schedule)
    {
        $departmentId = Auth::user()->department_id;
        $operatorTypeId = Auth::user()->operator_type_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $userId = User::where('role', 'operator')->where('department_id', $departmentId)->where('operator_type_id', $operatorTypeId)->pluck('id')->toArray();
       
        $users = User::whereIn('id', $userId)->get();
        $shifts = Shift::whereIn('id', $shiftId)->get();
        return view('operator.schedule.schedule-form', [
            'data' => $schedule, 
            'shifts' => $shifts, 
            'users' => $users, 
            'action' => route('operator.schedule.update', $schedule->id)
        ]);
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date_format:m-d-Y',
            'end_date' => 'nullable|date_format:m-d-Y|after_or_equal:start_date',
        ]);

        $departmentId = Auth::user()->department_id;
        $operatorTypeId = Auth::user()->operator_type_id;
        $userId = User::where('operator_type_id', $operatorTypeId)->pluck('id')->toArray();
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $startDate = Carbon::createFromFormat('m-d-Y', $request->start_date)->startOfDay()->toDateString();
        $endDate = Carbon::createFromFormat('m-d-Y', $request->end_date)->endOfDay()->toDateString();

        $schedules = Schedule::where(function($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate]);
        })->whereIn('shift_id', $shiftId)
        ->whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $scheduleCount = $schedules->count();
        $operatorCount = Schedule::where(function($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate]);
        })->whereIn('shift_id', $shiftId)
        ->whereIn('user_id', $userId)
        ->distinct('user_id')
        ->count('user_id');

        $pdf = PDF::loadView('operator.schedule.pdf', compact('schedules', 'scheduleCount', 'operatorCount', 'startDate', 'endDate'));

        return $pdf->stream('jadwal.pdf');
    }
}