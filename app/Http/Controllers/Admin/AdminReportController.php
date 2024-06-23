<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Auth;
use PDF;

class AdminReportController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $viewData = [];
        $viewData["title"] = "Laporan - Penjadwalan Shift";
        $viewData["subtitle"] = "Laporan Jadwal Kerja";
        $viewData["departments"] = Department::where('company_id', $companyId)->get();
        $viewData["operatorTypes"] = OperatorType::all();
        return view('admin.report.index')->with("viewData", $viewData);
    }

    public function generateAllSchedulePdf(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('admin.report.pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'operator_type_id' => 'nullable|exists:operator_types,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $companyId = Auth::user()->company_id;
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

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $scheduleQuery->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            });
        }

        $schedules = $scheduleQuery->orderBy('start_date')->get();
        $departmentName = $request->filled('department_id') ? Department::find($request->department_id)->getDepartmentName() : null;
        $operatorTypeName = $request->filled('operator_type_id') ? OperatorType::find($request->operator_type_id)->getOperatorNameType() : null;

        $pdf = PDF::loadView('admin.report.pdf', compact('schedules', 'departmentName', 'operatorTypeName'));

        return $pdf->stream('jadwal.pdf');
    }
}
