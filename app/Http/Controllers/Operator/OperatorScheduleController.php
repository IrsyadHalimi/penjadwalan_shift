<?php

namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class OperatorScheduleController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Jadwal - Penjadwalan Shift";
        $viewData["subtitle"] = "Daftar Jadwal Kerja";
        return view('operator.schedule.index')->with("viewData", $viewData);
    }

    public function listSchedule(Request $request)
    {
        $userId = Auth::user()->id;
        $departmentId = Auth::user()->department_id;
        $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();

        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date = date('Y-m-d', strtotime($request->end));

        $schedule = Schedule::where('start_date', '>=', $start_date)
            ->where('end_date', '<=', $end_date)
            ->where('user_id', $userId)
            ->where('shift_id', $shiftId)
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
}