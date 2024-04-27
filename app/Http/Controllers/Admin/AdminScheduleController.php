<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;

class AdminScheduleController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
        return view('admin.schedule.index')->with("viewData", $viewData);
    }

    public function listSchedule(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date = date('Y-m-d', strtotime($request->end));
        $schedule = Schedule::where('start_date', '>=', $start_date)
        ->where('end_date', '<=' , $end_date)->get()
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
                'end' => date('Y-m-d', strtotime($item->end_date. '+1 days')),
                'shift_id' => $item->shift_id,
                'className' => $label_color,
            ];
        });

        return response()->json($schedule);
    }

    public function create(Schedule $schedule)
    {
        $users = User::all();
        $shifts = Shift::all();
        return view('admin.schedule.schedule-form', [
            'data' => $schedule,
            'shifts' => $shifts, 
            'users' => $users, 
            'action' => route('schedule.store')
        ]);
    }

    public function store(EventRequest $request, Schedule $schedule)
    {
        return $this->update($request, $schedule);
    }

    public function edit(Schedule $schedule)
    {
        $users = User::all();
        $shifts = Shift::all();
        return view('admin.schedule.schedule-form', [
            'data' => $schedule, 
            'shifts' => $shifts, 
            'users' => $users, 
            'action' => route('schedule.update', $schedule->id)
        ]);
    }

    public function update(EventRequest $request, Schedule $schedule)
    {
        if ($request->has('delete')) {
            return $this->destroy($schedule);
        }
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->user_id = $request->user_id;
        $schedule->shift_id = $request->shift_id;

        $schedule->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Save data successfully'
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
