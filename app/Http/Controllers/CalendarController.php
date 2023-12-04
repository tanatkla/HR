<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->s;

        $lists = Event::where('account_id',null)->when($search, function ($q, $search) {
            $q->where('title', 'like', '%' . $search . '%');
            $q->orWhere('color', 'like', '%' . $search . '%');
         })->orderBy('start','desc')->paginate(10);
        
         $data = [
            'lists' => $lists,
            's' => $search,
        ];

       
        return view('calendar-manages.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'calendar' => null,
        ];
        return view('calendar-manages.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $calendar = Event::firstOrNew(['id' => $request->id]);
        $calendar->title = $request->title;
        $calendar->start = $request->start_date;
        $calendar->end = $request->end_date;
        $calendar->color = $request->color;
       //dd($calendar);

        $calendar->save();

        return redirect()->route('calendar-manage.index')->withSuccess('Data has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $calendar_manage)
    {
        //$position_list = Position::select('id', 'position_name as name')->get();
        $data = [
            'calendar' => $calendar_manage,
            'view' => true,
        ];

        return view('calendar-manages.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $calendar_manage)
    {
        //$lists = Event::select('id', 'title')->get();
        //dd($calendar_manage);
        $data = [
            'calendar' => $calendar_manage,
            //'lists' => $lists,

        ];
        
        return view('calendar-manages.form', $data);
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
        $calendar = Event::find($id);
        $calendar->delete();

        // return redirect()->route('dashboard.index');
        return response()->json(['success' => true]);
    }
}
