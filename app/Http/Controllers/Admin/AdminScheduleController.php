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


class AdminScheduleController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->pluck('id')->toArray();
        $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
        $viewData["shift"] = Shift::whereIn('department_id', $departmentId)->get();
        $viewData["schedules"] = Schedule::whereIn('user_id', $userId)->paginate(10);
        return view('admin.schedule.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = " Tambah Jadwal- Penjadwalan Shift";
        $viewData["subtitle"] = "Tambah Jadwal";
        $viewData["department"] = Department::where('company_id', $companyId)->get();
        $viewData["operators"] = User::whereIn('department_id', $departmentId)->get();
        $viewData["shifts"] = Shift::whereIn('department_id', $departmentId)->get();
        return view('admin.schedule.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $scheduleId = 'SCH' . Str::random(7);
        
        Schedule::validate($request);
        $newSchedule = new Schedule();
        $newSchedule->setId($scheduleId);
        $newSchedule->setUserId($request->input('user_id'));
        $newSchedule->setShiftId($request->input('shift_id'));
        $newSchedule->setStartDate($request->input('start_date'));
        $newSchedule->setEndDate($request->input('end_date'));
        $newSchedule->save();

        return redirect()->route('admin.schedule.index');
    }

    public function edit($id)
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
        $viewData["users"] = User::where('role', 'operator')->where('company_id', $companyId)->get();
        $viewData["shifts"] = Shift::whereIn('department_id', $departmentId)->get();
        
        $viewData = [];
        $viewData["title"] = "Admin - Edit Jadwal";
        $viewData["subtitle"] = "Edit Jadwal Kerja";
        $viewData["schedule"] = Schedule::findOrFail($id);
        $viewData["department"] = Department::where('company_id', $companyId)->get();
        return view('admin.schedule.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Schedule::validate($request); 
        $schedule = Schedule::findOrFail($id);
        $schedule->setStartDate($request->input('start_date'));
        $schedule->setEndDate($request->input('end_date'));
        $schedule->setUserId($request->input('user_id'));
        $schedule->setShiftId($request->input('shift_id'));
        $schedule->save();

        return redirect()->route('admin.schedule.index');
    }

    public function delete($id)
    {
        Schedule::destroy($id);
        return back();
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->pluck('id')->toArray();

        $schedules = Schedule::where(function($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
            ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
        })->whereIn('user_id', $userId)
        ->with('user')
        ->with('shift')
        ->orderBy('start_date')
        ->get();

        $pdf = PDF::loadView('admin.schedule.pdf', compact('schedules'));

        return $pdf->stream('jadwal.pdf');
    }
}