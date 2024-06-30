<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use App\Models\OperatorType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PDF;


class SupervisorReportController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Auth::user()->department_id;
        $viewData = [];
        $viewData["title"] = "Laporan - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Laporan Jadwal Shift Kerja Operator";
        $viewData["operator_type"] = OperatorType::where('department_id', $departmentId)->get();  
        return view('supervisor.report.index')->with("viewData", $viewData);
    }

    public function generateAllSchedulePdf(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Auth::user()->department_id;

        $departmentData = Department::where('id', $departmentId)->first();
        $departmentName = $departmentData->getDepartmentName();
        
        $userId = User::where('company_id', $companyId)->where('department_id', $departmentId)->where('role', 'operator')->pluck('id')->toArray();
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->whereIn('shift_id', $shiftId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $scheduleCount = $schedules->count();
        $operatorCount = Schedule::whereIn('user_id', $userId)->whereIn('shift_id', $shiftId)->distinct('user_id')->count('user_id');


        $pdf = PDF::loadView('supervisor.report.pdf', compact('schedules', 'departmentName', 'scheduleCount', 'operatorCount'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'operator_type_id' => 'nullable|exists:operator_types,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $companyId = Auth::user()->company_id;
        $departmentId = Auth::user()->department_id;
        $userQuery = User::where('company_id', $companyId)->where('role', 'operator');

        if ($request->filled('operator_type_id')) {
            $userQuery->where('operator_type_id', $request->operator_type_id);
        }

        $userId = $userQuery->pluck('id')->toArray();
        $scheduleQuery = Schedule::whereIn('user_id', $userId)->with('user', 'shift');

        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $scheduleQuery->whereIn('shift_id', $shiftId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $scheduleQuery->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            });
        }

        $schedules = $scheduleQuery->orderBy('start_date')->get();
        $departmentName = Department::find($departmentId)->getDepartmentName();
        $operatorTypeName = $request->filled('operator_type_id') ? OperatorType::find($request->operator_type_id)->getOperatorNameType() : 'Seluruh jenis operator';

        $scheduleCount = $scheduleQuery->count();
        $operatorCount = $scheduleQuery->distinct('user_id')->count('user_id');

        $pdf = PDF::loadView('supervisor.report.generate-by-range-pdf', compact('schedules', 'departmentName', 'operatorTypeName', 'scheduleCount', 'operatorCount'));

        return $pdf->stream('jadwal.pdf'); 
    }
}