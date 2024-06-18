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


class OperatorScheduleController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
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

    public function generatePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $departmentId = Auth::user()->department_id;
        $operatorTypeId = Auth::user()->operator_type_id;
        $userId = User::where('operator_type_id', $operatorTypeId)->pluck('id')->toArray();
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $schedules = Schedule::where(function($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
            ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
        })->whereIn('shift_id', $shiftId)
        ->whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('operator.schedule.pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generateAllSchedulePdf(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Auth::user()->department_id;
        $operatorTypeId = Auth::user()->operator_type_id;
        
        $userId = User::where('company_id', $companyId)->where('department_id', $departmentId)->where('operator_type_id', $operatorTypeId)->where('role', 'operator')->pluck('id')->toArray();
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->whereIn('shift_id', $shiftId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('operator.report.generate-all-schedule-pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }
}