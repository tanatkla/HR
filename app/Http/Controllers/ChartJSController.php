<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use DB;

class ChartJSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $now = Carbon::now();
        // $leaves = Leave::whereDate('leave_start_date', '>=', $now)
        //     ->whereDate('leave_end_date', '<=', $now)
        //     // ->select(DB::raw('COUNT(leaves.leave_type_id) as followers'))
        //     ->get();

        $leaves = Leave::whereDate('leave_start_date', '>=', $now)
            ->whereDate('leave_end_date', '<=', $now)
            ->where('leaves.status',STATUS_ACTIVE)
            ->select('leave_type_id', DB::raw('count(*) as leave_type_count'))
            ->groupBy('leave_type_id')
            ->get();
        // dd($now,$leaves);

        $sick_count = 0;
        $personal_count = 0;
        $vacation_count = 0;
        $maternity_count = 0;
        $training_count = 0;
        foreach ($leaves as $leave) {
            if ($leave->leave_type_id == 1) {
                $sick_count = $leave->leave_type_count;
            }
            if ($leave->leave_type_id == 2) {
                $personal_count = $leave->leave_type_count;
            }
            if ($leave->leave_type_id == 3) {
                $vacation_count = $leave->leave_type_count;
            }
            if ($leave->leave_type_id == 4) {
                $maternity_count = $leave->leave_type_count;
            }
            if ($leave->leave_type_id == 5) {
                $training_count = $leave->leave_type_count;
            }
        }
        // dd($sick_count,$personal_count,$vacation_count,$maternity_count,$training_count);



        $users = User::leftjoin('positions', 'positions.id', '=', 'users.position_id')
            ->select('positions.position_name', DB::raw("COUNT('users.position_id') as count"))
            ->groupBy('position_name')
            // ->orderBy('id','ASC')
            ->pluck('count', 'position_name');

        $leaves_chart = Leave::leftjoin('leave_types', 'leave_types.id', '=', 'leaves.leave_type_id')
        // ->whereDate('leave_start_date', '>=', $now)
        // ->whereDate('leave_end_date', '<=', $now)
        ->where('leaves.status',STATUS_ACTIVE)
        ->whereMonth('leaves.leave_start_date', Carbon::now()->month)
        ->select(DB::raw('count(*) as leave_type_count'),'leave_types.name')
        ->groupBy('leave_types.name')
        ->pluck('leave_type_count', 'leave_types.name');
        // dd($leaves);

        $labels = $leaves_chart->keys();
        $data = $leaves_chart->values();
        // dd($users,$labels,$data);

        return view('home', compact('labels', 'data', 'sick_count', 'personal_count', 'vacation_count', 'maternity_count', 'training_count'));
    }
}
