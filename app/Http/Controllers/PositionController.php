<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $position = new Position();
        $position->status = STATUS_ACTIVE;
        $search = $request->search;

        $lists = Position::when($search, function ($q, $search) {$q->where('position_name', 'like', '%' . $search . '%');
            
         })->orderBy('id','desc')->paginate(10);
        $data = [
            'lists' => $lists,
            'position' => $position,
            'search' => $search,
        ];

        return view('positions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = new Position();
        $position->status = 1;
        $data = [
            'position' => $position,
        ];

        return view('positions.form', $data);
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
        $position = Position::firstOrNew(['id' => $request->id]);
        $position->position_name = $request->position_name;
        $position->status = $request->status;

        $position->save();
        // dd('success');

        // return redirect()->route('position.index');
        return redirect(route('position.index'))->withSuccess('Data has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        $data = [
            'position' => $position,
            'view' => true,
        ];

        return view('positions.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $data = [
            'position' => $position,
        ];

        return view('positions.form', $data);
        return response()->json(
            [
                'success' => true,
                'data'   => $data
            ]
        );
    }

    public function getDataEdit(Request $request)
    {
        // dd('dssdsd');
        $data = Position::find($request->id);
        // dd($data);

        
        // return view('positions.form', $data);
        return response()->json(
            [
                'success' => true,
                'data'   => $data
            ]
        );
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
        $position = Position::find($id);
        $position->delete();

        // return redirect()->route('dashboard.index');
        return response()->json(['success' => true]);
    }
}
