<?php

namespace App\Http\Controllers\Admin;
use App\Notifications\ScheduleUpdatedNotification;
use App\Notifications\ScheduleChangedNotification;
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
use Carbon\Carbon;


class AdminScheduleController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Daftar Jadwal";
        return view('admin.schedule.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = " Jadwal - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Tambah Jadwal";
        $viewData["departments"] = Department::where('company_id', $companyId)->get();
        $viewData["operators"] = User::whereIn('department_id', $departmentId)->get();
        $viewData["shifts"] = Shift::whereIn('department_id', $departmentId)->get();
        return view('admin.schedule.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $startDate = Carbon::createFromFormat('m-d-Y', $request->start_date)->startOfDay()->format('Y-m-d');
        $endDate = Carbon::createFromFormat('m-d-Y', $request->end_date)->endOfDay()->format('Y-m-d');


        $scheduleId = 'SCH' . Str::random(7);
        $newSchedule = new Schedule();
        $newSchedule->setId($scheduleId);
        $newSchedule->setUserId($request->input('user_id'));
        $newSchedule->setShiftId($request->input('shift_id'));
        $newSchedule->setStartDate($startDate);
        $newSchedule->setEndDate($endDate);
        $newSchedule->save();

        return redirect()->route('admin.schedule.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $companyId = Auth::user()->company_id;
        $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
        $viewData["users"] = User::where('role', 'operator')->where('company_id', $companyId)->get();
        $viewData["shifts"] = Shift::whereIn('department_id', $departmentId)->get();
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Edit Jadwal";
        $viewData["schedule"] = Schedule::findOrFail($id);
        $viewData["departments"] = Department::where('company_id', $companyId)->get();
        return view('admin.schedule.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $oldSchedule = $schedule->replicate();

        $changedUserNotification = false;

        if ($id != $request->user_id) {
            $changedUserNotification = true;
        }

        $schedule->setStartDate($request->input('start_date'));
        $schedule->setEndDate($request->input('end_date'));
        $schedule->setUserId($request->input('user_id'));
        $schedule->setShiftId($request->input('shift_id'));
        $schedule->save();

        if ($changedUserNotification) {
            $newSchedule = $schedule->fresh();
            $sender = auth()->user();
            $oldUser = User::find($oldSchedule->user_id);
            $newUser = User::find($request->user_id);
        
            if ($oldUser) {
                Notification::send($oldUser, new ScheduleChangedNotification(
                    $sender->toArray(),
                    $oldSchedule->toArray(),
                    $newSchedule->toArray(),
                    $oldUser->id,
                    $newUser ? $newUser->id : null
                ));
            }

            if ($newUser) {
                Notification::send($newUser, new ScheduleChangedNotification(
                    $sender->toArray(),
                    $oldSchedule->toArray(),
                    $newSchedule->toArray(),
                    $oldUser ? $oldUser->id : null,
                    $newUser->id
                ));
            }
        } else {
            $newSchedule = $schedule->fresh();
            $user = User::find($request->user_id);
            $sender = Auth::user();
            $operator = User::find($request->user_id);
            
            Notification::send($user, new ScheduleUpdatedNotification(
                $sender->toArray(), 
                $operator->toArray(), 
                $oldSchedule->toArray(), 
                $newSchedule->toArray()
            ));
        
        }
        return redirect()->route('admin.schedule.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        Schedule::destroy($id);
        return back()->with('success', 'Data berhasil dihapus.');
    }
}