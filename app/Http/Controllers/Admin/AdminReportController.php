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
        $viewData = [];
        $viewData["title"] = "Laporan - Penjadwalan Shift";
        $viewData["subtitle"] = "Laporan Jadwal Kerja";
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
}