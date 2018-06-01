<?php

namespace App\Http\Controllers;

use App\Item;
use App\Lists;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{

    /**
     * Show the form for crating the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function create(Lists $list)
    {
        return view('items.create', ['list'=>$list->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['description'=>'required']);

        $board = Lists::find($request->get('list'))->board;

        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        $data = [
                'description' => $request->get('description'),
                'list_id' => $request->get('list'),
            ];

        try{
            Item::create($data);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.show', $board))->with(['success' => 'Item was created successfully.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $board = $item->list->board;
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        return view('items.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, ['description'=>'required|min:2']);

        $board = $item->list->board;
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        try{
            $item->update(['description' => $request->get('description')]);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }
        return redirect(route('boards.show', $board))->with(['success' => 'Item was updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $board = $item->list->board;
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        try{
            $item->delete();
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.show', $board))
        ->with(['success' => 'Item was deleted successfully.']);
    }
}
