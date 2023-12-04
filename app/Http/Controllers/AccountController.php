<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Account;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s = $request->s;
        $lists = User::leftjoin('positions','positions.id','=','users.position_id')->when($s, function ($q, $s) {
            
            $q->where('users.firstname', 'like', '%' . $s . '%');
            $q->orWhere('users.lastname', 'like', '%' . $s . '%');
            $q->orWhere('positions.position_name', 'like', '%' . $s . '%');
        })->select('users.*','positions.position_name')->orderBy('id','desc')->paginate(10);
        // dd($lists);
        $data = [
            'lists' => $lists,
            's' => $s,
        ];
       
        return view('accounts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position_list = Position::select('id', 'position_name as name')->get();
        $data = [
            'position_list' => $position_list,
            'dash' => null,
        ];
        return view('accounts.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required|unique:posts|max:255',
            
            'lastname' => 'required',
            'firstname' => 'required',
        ],[],[
            
            'lastname' => 'A lastname is required',
            'firstname' => 'A firstname is required',
        ]);
     
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
     
           
        }
        // dd($request->all());
        $account = User::firstOrNew(['id' => $request->id]);
        $account->firstname = $request->firstname;
        $account->lastname = $request->lastname;
        $account->position_id = $request->position;
        $account->name = $request->name;
        $account->email = $request->email;
        $account->start_job = $request->start_job;


        $account->password = Hash::make($request->password);

        $account->save();
        // dd('success');
        // event(new MessageSent($account->firstname));
        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $account)
    {
        // dd($dashboard);
        $position_list = Position::select('id', 'position_name as name')->get();
        $data = [
            'dash' => $account,
            'view' => true,
            'position_list' => $position_list,
        ];

        return view('accounts.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $account)
    {
        $position_list = Position::select('id', 'position_name as name')->get();
        //dd($account);
        $data = [
            'dash' => $account,
            'position_list' => $position_list,

        ];

        return view('accounts.form', $data);
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
        // dd($id);
        $account = User::find($id);
        $account->delete();

        // return redirect()->route('dashboard.index');
        return response()->json(['success' => true]);
    }
}
