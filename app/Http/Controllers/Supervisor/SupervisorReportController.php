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
        $viewData["title"] = "Laporan - Penjadwalan Shift";
        $viewData["subtitle"] = "Laporan Jadwal Kerja";
        $viewData["department"] = Department::where('company_id', $companyId)->get();  
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

        $pdf = PDF::loadView('supervisor.report.pdf', compact('schedules', 'departmentName'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generateByOperatorTypePdf(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'operator_type_id' => 'required',
        ]);
        
        $departmentId = $request->department_id;
        $operatorTypeId = $request->operator_type_id;

        $companyId = Auth::user()->company_id;
        
        $departmentData = Department::where('id', $departmentId)->first();
        $operatorTypeData = OperatorType::where('id', $operatorTypeId)->first();
        
        $departmentName = $departmentData->getDepartmentName();
        $operatorTypeName = $operatorTypeData->getOperatorNameType();
        
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->where('operator_type_id', $operatorTypeId)->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->whereIn('shift_id', $shiftId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('supervisor.report.generate-by-operator-type-pdf', compact('schedules', 'departmentName', 'operatorTypeName'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generateByRangePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $companyId = Auth::user()->company_id;
        $departmentId = Auth::user()->department_id;

        $userId = User::where('company_id', $companyId)->where('department_id', $departmentId)->where('role', 'operator')->pluck('id')->toArray();

        $schedules = Schedule::where(function($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
            ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
        })->whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('operator.schedule.pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }
}