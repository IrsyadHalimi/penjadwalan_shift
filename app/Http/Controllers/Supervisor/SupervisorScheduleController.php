<?php

namespace App\Http\Controllers\Supervisor;
use App\Notifications\ScheduleUpdatedNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Department;
use App\Models\User;
use App\Models\OperatorType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PDF;


class SupervisorScheduleController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
        $viewData["shift"] = Shift::whereIn('id', $shiftId)->get();
        $viewData["operator_type"] = OperatorType::where('department_id', $departmentId)->get();
        return view('supervisor.schedule.index')->with("viewData", $viewData);
    }

    public function listSchedule(Request $request)
    {
        $departmentId = Auth::user()->department_id;
        $operatorTypeId = $request->operator_type_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $userId = User::where('department_id', $departmentId)
                    ->where('role', 'operator')
                    ->where('operator_type_id', $operatorTypeId)
                    ->pluck('id')
                    ->toArray();

        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date = date('Y-m-d', strtotime($request->end));

        $schedule = Schedule::where('start_date', '>=', $start_date)
                            ->where('end_date', '<=', $end_date)
                            ->whereIn('user_id', $userId)
                            ->whereIn('shift_id', $shiftId)
                            ->get()
                            ->map(function ($item) {
                                $shift = Shift::find($item->shift_id);
                                $user = User::find($item->user_id);
                                $label_color = $shift ? ['bg-' . $shift->label_color] : [];
                                $user_label_name = $user ? [$user->full_name] : [];

                                return [
                                    'id' => $item->id,
                                    'user_id' => $item->user_id,
                                    'title' => $user_label_name,
                                    'start' => $item->start_date,
                                    'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                                    'shift_id' => $item->shift_id,
                                    'className' => $label_color,
                                ];
                            });

        return response()->json($schedule);
    }


    public function create(Schedule $schedule)
    {
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $operatorTypeId = OperatorType::where('department_id', $departmentId)->pluck('id')->toArray();
        $userId = User::where('role', 'operator')->where('department_id', $departmentId)->pluck('id')->toArray();
       
        $users = User::whereIn('id', $userId)->get();
        $operatorTypes = User::whereIn('operator_type_id', $operatorTypeId)->get();
        $shifts = Shift::whereIn('id', $shiftId)->get();
        return view('supervisor.schedule.schedule-form', [
            'data' => $schedule,
            'shifts' => $shifts, 
            'users' => $users, 
            'action' => route('supervisor.schedule.store')
        ]);
    }

    public function store(EventRequest $request)
    {
        $scheduleId = 'SCH' . Str::random(7);

        $schedule = new Schedule();
        $schedule->id = $scheduleId;
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->user_id = $request->user_id;
        $schedule->shift_id = $request->shift_id;
        $schedule->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Save data store successfully'
        ]);
    }

    public function edit(Schedule $schedule)
    {
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
        $userId = User::where('role', 'operator')->where('department_id', $departmentId)->pluck('id')->toArray();
       
        $users = User::whereIn('id', $userId)->get();
        $shifts = Shift::whereIn('id', $shiftId)->get();
        return view('supervisor.schedule.schedule-form', [
            'data' => $schedule, 
            'shifts' => $shifts, 
            'users' => $users, 
            'action' => route('supervisor.schedule.update', $schedule->id)
        ]);
    }

    public function update(EventRequest $request, Schedule $schedule)
    {
        if ($request->has('delete')) {
            return $this->destroy($schedule);
        }

        $oldSchedule = clone $schedule;

        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->user_id = $request->user_id;
        $schedule->shift_id = $request->shift_id;
        $schedule->save();

        $newSchedule = $schedule;
        $user = User::find($request->user_id);

        // Menggunakan queue untuk mengirim notifikasi
        Notification::send($user, new ScheduleUpdatedNotification($oldSchedule, $newSchedule));

        return response()->json([
            'status' => 'success',
            'message' => 'Save data update successfully'
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}