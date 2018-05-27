<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Board;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class ListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Board $board)
    {
        return view('lists.create', ['board'=>$board->id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title'=>'required']);

        if($request->get('board') != \Auth::user()->id)
        {
            return redirect('/');
        }

        $board = Board::find($request->get('board'));
        
        count($board->list)==0 ? $order = 1:  $order = $board->list[0]->order+1;

        $data = [
                'title' => $request->get('title'),
                'board_id' => $request->get('board'),
                'order' => $order
            ];
        
        try{
            Lists::create($data);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.show', $board))->with(['success' => 'List was created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function show(Lists $lists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function edit(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lists $lists)
    {
        //
    }
}
