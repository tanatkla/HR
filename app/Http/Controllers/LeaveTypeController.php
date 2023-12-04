<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = LeaveType::orderBy('id','desc')->paginate(10);
        // dd($lists);
        $data = [
            'lists' => $lists,
            // 's' => $s,
        ];
        return view('leave-types.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $leave_list = (object)(
        //     [
                
        //     'id' =>'sdfsdffds',
        //     // 'value' => 'sfsf',
        //     'name' => 'dfdf',
        // ]
            // );
        // dd($leave_list);
        $data = [
            // 'leave_list' => $leave_list,
            'leave' => null,
        ];
        return view('leave-types.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->reset == 'on'){
        //    dd('dd');
        // dd($request->id);
            if($request->id == 1){ //ลาป่วย
                
                $account = Account::query()->update(['sick_leave' => 30]);
            }
           
        }

        return redirect(route('leave-type.index'))->withSuccess('Data has been saved');
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
    public function edit(LeaveType $leave_type)
    {
        // dd($leave_type);
        $data = [
            'leave_type' => $leave_type,
        ];

        return view('leave-types.form', $data);
       
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
