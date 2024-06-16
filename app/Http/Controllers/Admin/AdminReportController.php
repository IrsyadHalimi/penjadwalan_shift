<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Support\Str;
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
        $viewData["department"] = Department::where('company_id', $companyId)->get();  
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

    public function generateByDepartmentPdf(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
        ]);

        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->pluck('id')->toArray();
        $departmentId = $request->department_id;
        $departmentData = Department::where('id', $departmentId)->first();
        $departmentName = $departmentData->getDepartmentName();

        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $schedules = Schedule::whereIn('user_id', $userId)
        ->whereIn('shift_id', $shiftId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('admin.report.generate-by-department-pdf', compact('schedules', 'departmentName'));

        return $pdf->stream('jadwal.pdf');
    }
}