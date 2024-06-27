<?php

namespace App\Http\Controllers\Superadmin;
use App\Notifications\ScheduleUpdatedNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class SuperadminScheduleController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
        return view('superadmin.schedule.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData["title"] = " Tambah Jadwal- Penjadwalan Shift";
        $viewData["subtitle"] = "Tambah Jadwal";
        $viewData["departments"] = Department::all();
        $viewData["operators"] = User::all();
        $viewData["shifts"] = Shift::all();
        return view('superadmin.schedule.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $scheduleId = 'SCH' . Str::random(7);
        $newSchedule = new Schedule();
        $newSchedule->setId($scheduleId);
        $newSchedule->setUserId($request->input('user_id'));
        $newSchedule->setShiftId($request->input('shift_id'));
        $newSchedule->setStartDate($request->input('start_date'));
        $newSchedule->setEndDate($request->input('end_date'));
        $newSchedule->save();

        return redirect()->route('superadmin.schedule.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin - Edit Jadwal";
        $viewData["subtitle"] = "Edit Jadwal Kerja";
        $viewData["schedule"] = Schedule::findOrFail($id);
        return view('superadmin.schedule.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $oldSchedule = $schedule->replicate();

        $schedule->setStartDate($request->input('start_date'));
        $schedule->setEndDate($request->input('end_date'));
        $schedule->setUserId($request->input('user_id'));
        $schedule->setShiftId($request->input('shift_id'));
        $schedule->save();

        $newSchedule = $schedule->fresh();
        $user = User::find($request->user_id);
        $sender = Auth::user();

        Notification::send($user, new ScheduleUpdatedNotification($sender->toArray(), $oldSchedule->toArray(), $newSchedule->toArray()));

        return redirect()->route('superadmin.schedule.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        Schedule::destroy($id);
        return back()->with('success', 'Data berhasil dihapus.');
    }
}