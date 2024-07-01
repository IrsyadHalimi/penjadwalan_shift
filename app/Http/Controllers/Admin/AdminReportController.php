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
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $viewData = [];
        $viewData["title"] = "Laporan - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Laporan Jadwal Shift Kerja Operator";
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

        $scheduleCount = $schedules->count();
        $operatorCount = Schedule::whereIn('user_id', $userId)->distinct('user_id')->count('user_id');

        $pdf = PDF::loadView('admin.report.pdf', compact('schedules', 'scheduleCount', 'operatorCount'));

        return $pdf->stream('jadwal.pdf');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'operator_type_id' => 'nullable|exists:operator_types,id',
            'start_date' => 'nullable|date_format:m-d-Y',
            'end_date' => 'nullable|date_format:m-d-Y|after_or_equal:start_date',
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

        $startDate = Carbon::createFromFormat('m-d-Y', $request->start_date)->startOfDay()->toDateString();
        $endDate = Carbon::createFromFormat('m-d-Y', $request->end_date)->endOfDay()->toDateString();

        $scheduleQuery->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate]);
        });

        $schedules = $scheduleQuery->orderBy('start_date')->get();
        $departmentName = $request->filled('department_id') ? Department::find($request->department_id)->getDepartmentName() : 'Seluruh departemen';
        $operatorTypeName = $request->filled('operator_type_id') ? OperatorType::find($request->operator_type_id)->getOperatorNameType() : 'Seluruh jenis operator';
        
        $scheduleCount = $scheduleQuery->count();
        $operatorCount = $scheduleQuery->distinct('user_id')->count('user_id');

        $pdf = PDF::loadView('admin.report.generate-by-range-pdf', compact('schedules', 'departmentName', 'operatorTypeName', 'scheduleCount', 'operatorCount', 'startDate', 'endDate'));

        return $pdf->stream('jadwal.pdf'); 
    }

    public function generateByMonth(Request $request)
    {
        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'operator_type_id' => 'nullable|exists:operator_types,id',
            'month' => 'required|date_format:Y-m', // Validasi format bulan (YYYY-MM)
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
    
        // Ambil bulan dari input
        $month = $request->month;
        $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endOfMonth = Carbon::createFromFormat('Y-m', $month)->endOfMonth();
    
        // Filter berdasarkan bulan
        $scheduleQuery->where(function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('start_date', [$startOfMonth, $endOfMonth]);
        });
    
        $schedules = $scheduleQuery->orderBy('start_date')->get();
        $departmentName = $request->filled('department_id') ? Department::find($request->department_id)->getDepartmentName() : 'Seluruh departemen';
        $operatorTypeName = $request->filled('operator_type_id') ? OperatorType::find($request->operator_type_id)->getOperatorNameType() : 'Seluruh jenis operator';
        
        $scheduleCount = $scheduleQuery->count();
        $operatorCount = $scheduleQuery->distinct('user_id')->count('user_id');
        Carbon::setLocale('id');
        $selectedMonth = Carbon::createFromFormat('Y-m', $month)->translatedFormat('F Y');
    
        $pdf = PDF::loadView('admin.report.generate-by-month-pdf', compact('schedules', 'departmentName', 'operatorTypeName', 'scheduleCount', 'operatorCount', 'selectedMonth'));
    
        return $pdf->stream('jadwal.pdf'); 
    }
}
