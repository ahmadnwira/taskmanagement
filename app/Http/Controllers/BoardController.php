<?php

namespace App\Http\Controllers;

use App\Board;
use App\User;
use App\BoardUser;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = \Auth::user()->owned_boards;
        return view('boards.index', ['boards'=>$boards]);
    }

    /**
     * Show the form for creating a new Board.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created Board in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title'=>'required|min:2']);

        $data = ['title'=>$request->get('title'), 'user_id'=>\Auth::user()->id];

        try{
            Board::create($data);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }


        return redirect(route('boards.index'))->with(['success' => 'Board was created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {

        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }
        return view('boards.board', [
            'board'=>$board->id,
            'lists' => $board->list
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }
        return view('boards.edit', ['board'=>$board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        $this->validate($request, ['title'=>'required|min:2']);

        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        try{
            $board->update(['title' => $request->get('title')]);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.index'))->with(['success' => 'Board was updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        try{
            $board->delete();
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.index'))->with(['success' => 'Board was deleted successfully.']);
    }

    public function share(Request $request, Board $board)
    {
        if(Gate::denies('board-owner', $board))
        {
            return redirect('/');
        }

        $this->validate($request, ['username' => 'required']);


        try{
            $user = User::select('id')->where('name', $request->get('username'))->firstOrFail();
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        if(auth()->id() == $user->id){
            return redirect(route('boards.index'))->with(['error' => 'you cant\'t share board with yourself.']);
        }

        try{
            BoardUser::create([
                'user_id' => $user->id,
                'board_id' => $board->id
            ]);
        }
        catch(QueryException $e){
            return response()->view('errors.500', [], 500);
        }

        return redirect(route('boards.index'))->with(['success' => 'Board was shared successfully.']);
    }


    public function shared()
    {
        $user = User::find(auth()->id());
        $boards = $user->shared_boards;
        return view('boards.index', ['boards'=>$boards]);
    }
}
