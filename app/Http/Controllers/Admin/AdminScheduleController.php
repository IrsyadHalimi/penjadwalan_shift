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
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
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
}