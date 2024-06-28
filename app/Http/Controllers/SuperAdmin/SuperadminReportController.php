<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Auth;
use PDF;

class SuperadminReportController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Laporan - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Laporan Jadwal Shift Kerja Operator";
        $viewData["departments"] = Department::all();
        $viewData["operatorTypes"] = OperatorType::all();
        return view('superadmin.report.index')->with("viewData", $viewData);
    }

    public function generateAllSchedulePdf(Request $request)
    {
        $userId = User::where('role', 'operator')->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('superadmin.report.pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'company_id' => 'nullable|exists:companies,id',
            'department_id' => 'nullable|exists:departments,id',
            'operator_type_id' => 'nullable|exists:operator_types,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $companyId = $request->company_id;
        $userQuery = User::where('company_id', $companyId)->where('role', 'operator');

        if ($request->filled('operator_type_id')) {
            $userQuery->where('operator_type_id', $request->operator_type_id);
        }

        $userId = $userQuery->pluck('id')->toArray();
        $scheduleQuery = Schedule::whereIn('user_id', $userId)->with('user', 'shift');

        if ($request->filled('department_id')) {
            $shiftId = Shift::where('department_id', $request->department_id)->pluck('id')->toArray();
            $scheduleQuery->whereIn('shift_id', $shiftId);
        }
        
        if ($request->filled('company_id')) {
            $userQuery->where('company_id', $request->company_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $scheduleQuery->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            });
        }

        $schedules = $scheduleQuery->orderBy('start_date')->get();
        
        $departmentName = $request->filled('department_id') ? Department::find($request->department_id)->getDepartmentName() : null;
        
        $operatorTypeName = $request->filled('operator_type_id') ? OperatorType::find($request->operator_type_id)->getOperatorNameType() : null;

        $pdf = PDF::loadView('superadmin.report.pdf', compact('schedules', 'departmentName', 'operatorTypeName'));

        return $pdf->stream('jadwal.pdf');
    }
}
