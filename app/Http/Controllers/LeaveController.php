<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Event;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->position_id);
        // $s = $request->s;
        $lists = Leave::leftjoin('leave_types', 'leave_types.id', '=', 'leaves.leave_type_id')
            ->leftjoin('users', 'users.id', '=', 'leaves.account_id')

            ->when(Auth::user()->position_id != 1, function ($q, $search) {
                $q->where('leaves.account_id', Auth::user()->id);
            })
            ->select('leaves.*', 'leave_types.name as leave_type_name', 'users.firstname', 'users.lastname')->orderBy('id', 'desc')->paginate(10);
        // dd($lists);
        $data = [
            'lists' => $lists,
            // 's' => $s,
        ];
        return view('leaves.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leave_types_list = LeaveType::select('id', 'name')->get();
        $user = User::find(Auth::user()->id);
        $user->sick_leave_hours = $user->sick_leave % 8;
        $user->sick_leave = $user->sick_leave / 8;
        $user->personal_leave_hours = $user->personal_leave % 8;
        $user->personal_leave = $user->personal_leave / 8;
        $user->vacation_leave_hours = $user->vacation_leave % 8;
        $user->vacation_leave = $user->vacation_leave / 8;
        $user->maternity_leave_hours = $user->maternity_leave % 8;
        $user->maternity_leave = $user->maternity_leave / 8;
        $user->training_leave_hours = $user->training__leave % 8;
        $user->training_leave = $user->training_leave / 8;
        $user->vacation_leave_total = $user->vacation_leave_total / 8;

        // dd($user);
        $data = [
            'leave_types_list' => $leave_types_list,
            'dash' => null,
            'user' => $user,
        ];
        return view('leaves.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $leave = Leave::firstOrNew(['id' => $request->id]);
        // dd($leave);


        if ($leave->account_id == Auth::user()->id || is_null($request->id)) { //สร้าง แก้ไข ด้วยตัวเอง

            $user = User::find(Auth::user()->id);
        } elseif ($leave->account_id != Auth::user()->id) { // แก้ไขด้วย admin
            // $user = User::find($leave->account_id);

            $user = User::find($leave->account_id);

            // dd($user);

        }
        $date_diff = abs(strtotime($leave->leave_end_date) - strtotime($leave->leave_start_date));
        // dd($date_diff);

        $years = floor($date_diff / (365 * 60 * 60 * 24));
        $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

        $day_hours = $days * 8;
        $hour_hours = 0;
        if ($hours <= 4) {
            $hour_hours = $hours;
        } elseif ($hours >= 5 && $hours <= 9) {
            $hour_hours = $hours - 1;
        } else {
            $hour_hours = 8;
        }

        if ($leave->leave_type_id == 1) {
            $user->sick_leave = $user->sick_leave + ($day_hours + $hour_hours);
        } else if ($leave->leave_type_id == 2) {
            $user->personal_leave = $user->personal_leave + ($day_hours + $hour_hours);
        } else if ($leave->leave_type_id == 3) {
            $user->vacation_leave = $user->vacation_leave + ($day_hours + $hour_hours);
        } else if ($leave->leave_type_id == 4) {
            $user->maternity_leave = $user->maternity_leave + ($day_hours + $hour_hours);
        } else if ($leave->leave_type_id == 5) {
            $user->training_leave = $user->training_leave + ($day_hours + $hour_hours);
        }
        $user->save();

        $date_diff = abs(strtotime($request->leave_end_date) - strtotime($request->leave_start_date));

        $years = floor($date_diff / (365 * 60 * 60 * 24));
        $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

        // dd($years . ' ' . $months . ' ' . $days . ' ' .$hours);
        $day_hours = $days * 8;
        $hour_hours = 0;
        if ($hours <= 4) {
            $hour_hours = $hours;
        } elseif ($hours >= 5 && $hours <= 9) {
            $hour_hours = $hours - 1;
        } else {
            $hour_hours = 8;
        }

        $leave = Leave::firstOrNew(['id' => $request->id]);

        // dd($user);
        // $user = User::find(Auth::user()->id);
        if ($request->leave_type_id == 1) {
            $user->sick_leave = $user->sick_leave - ($day_hours + $hour_hours);
        } else if ($request->leave_type_id == 2) {
            $user->personal_leave = $user->personal_leave - ($day_hours + $hour_hours);
        } else if ($request->leave_type_id == 3) {
            $user->vacation_leave = $user->vacation_leave - ($day_hours + $hour_hours);
        } else if ($request->leave_type_id == 4) {
            $user->maternity_leave = $user->maternity_leave - ($day_hours + $hour_hours);
        } else if ($request->leave_type_id == 5) {
            $user->training_leave = $user->training_leave - ($day_hours + $hour_hours);
        }


        $user->save();

        $leave->leave_type_id = $request->leave_type_id;
        $leave->leave_start_date = $request->leave_start_date;
        $leave->leave_end_date = $request->leave_end_date;
        $leave->leave_reason = $request->leave_reason;
        $leave->status = 3;
        if ($leave->account_id == Auth::user()->id || is_null($leave->account_id)) {
            $leave->account_id = Auth::user()->id;
        }

        $leave->save();
        event(new MessageSent(Auth::user()->name));
        // dd($leave);
        return redirect()->route('leave.index');
        // ret

    }

    public function updateStatus(Request $request)
    {

        // dd($request->all());
        if (isset($request->check)) {
            if ($request->status == STATUS_ACTIVE) {
                foreach ($request->check as $index => $data) {
                    $leave = Leave::find($index);
                    // dd($leave);
                    $leave_type = LeaveType::find($leave->leave_type_id);
                    $user_name = User::find($leave->account_id);
                    // dd($leave);
                    $leave->status = STATUS_ACTIVE;
                    $leave->save();

                    $leave_name = $user_name->firstname . ' (' . $leave_type->name . ')';
                    $event = new Event();
                    $event->title = $leave_name;
                    $event->start = $leave->leave_start_date;
                    $daysToAdd = 1;
                    $end_day = $leave->leave_end_date;
                    // $end_day = date('Y-m-d', strtotime($end_day . "+1 days"));
                    $event->end = $end_day;
                    $event->account_id = $leave->account_id;
                    
                    if ($leave->leave_type_id == 1) {
                        $event->color = "#F0B67F";
                    }else if ($leave->leave_type_id == 2) {
                        $event->color = "#8380B6";
                    }else if ($leave->leave_type_id == 3) {
                        $event->color = "#FE5F55";
                    }else if ($leave->leave_type_id == 4) {
                        $event->color = "#05A8AA";
                    }else if ($leave->leave_type_id == 5) {
                        $event->color = "#445E93";
                    }

                    $event->save();
                }
            } else {
                foreach ($request->check as $index => $data) {
                    $leave = Leave::find($index);



                    $date_diff = abs(strtotime($leave->leave_end_date) - strtotime($leave->leave_start_date));
                    // dd($date_diff);

                    $years = floor($date_diff / (365 * 60 * 60 * 24));
                    $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $hours = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

                    // dd($years . ' ' . $months . ' ' . $days . ' ' .$hours);
                    $day_hours = $days * 8;
                    $hour_hours = 0;
                    if ($hours <= 4) {
                        $hour_hours = $hours;
                    } elseif ($hours >= 5 && $hours <= 9) {
                        $hour_hours = $hours - 1;
                    } else {
                        $hour_hours = 8;
                    }

                    // dd($day_hours , $hour_hours);

                    $user = User::find($leave->account_id);


                    if ($leave->leave_type_id == 1) {
                        $user->sick_leave = $user->sick_leave + ($day_hours + $hour_hours);
                    } else if ($leave->leave_type_id == 2) {
                        $user->personal_leave = $user->personal_leave + ($day_hours + $hour_hours);
                    } else if ($leave->leave_type_id == 3) {
                        $user->vacation_leave = $user->vacation_leave + ($day_hours + $hour_hours);
                    } else if ($leave->leave_type_id == 4) {
                        $user->maternity_leave = $user->maternity_leave + ($day_hours + $hour_hours);
                    } else if ($leave->leave_type_id == 5) {
                        $user->training_leave = $user->training_leave + ($day_hours + $hour_hours);
                    }

                    // dd($leave);
                    $leave->status = 2;
                    $leave->save();
                    $user->save();
                }
            }
        }

        // return redirect()->route('leave.index');
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {

        $leave_types_list = LeaveType::select('id', 'name')->get();
        $user = User::find($leave->account_id);
        // dd($user);
        $user->sick_leave_hours = $user->sick_leave % 8;
        $user->sick_leave = $user->sick_leave / 8;
        $user->personal_leave_hours = $user->personal_leave % 8;
        $user->personal_leave = $user->personal_leave / 8;
        $user->vacation_leave_hours = $user->vacation_leave % 8;
        $user->vacation_leave = $user->vacation_leave / 8;
        $user->maternity_leave_hours = $user->maternity_leave % 8;
        $user->maternity_leave = $user->maternity_leave / 8;
        $user->training_leave_hours = $user->training_leave % 8;
        $user->training_leave = $user->training_leave / 8;
        $user->vacation_leave_total = $user->vacation_leave_total / 8;

        // dd($leave);
        $data = [
            'leave_types_list' => $leave_types_list,
            'leave' => $leave,
            'user' => $user,
        ];
        return view('leaves.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
