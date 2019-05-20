<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use Carbon\Carbon;


class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();  //現在認証中のuser idを取得
        $punchIn = Carbon::now(); //viewへのaccess時の時刻を取得
        return view('record', compact('user_id', 'punchIn'));
    }

    /**
     * 時間の登録
     *
     * @return \Illuminate\Http\Response
     */
    public function punchIn(Request $request)
    {
        $tasks = new Task;  //Taskインスタンス作成→$tasksへ代入, この時点では空
        $form = $request->all(); //$formにtasks tableのall dataを取得し代入

        unset($form['_token']); //allではトークンも一緒なのでunsetで削除

        $tasks->fill($form); //$formの内容を$tasksにfillする
        $tasks->punchIn = Carbon::now(); //$tasksのpanchInに挿入しているFieldを上書き
        $tasks->save(); //$tasksの中身をsaveする
        return redirect('record');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
