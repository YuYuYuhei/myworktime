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
        return redirect('update');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user_id = Auth::id(); //ユーザーIDを取得
        $tasks = Task::where('user_id', $user_id)->latest()->first();
            //ユーザーの最新のテーブルの行を取得
            //->first()だとid番号の小さいやつから1つだけ取ってくる
            //->latest()->first()でid番号が最後のやつを1つだけ取ってくる
        return view('update', compact('user_id', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function punchOut(Request $request)
    {
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $tasks->punchOut = Carbon::now();
        $tasks->save();

        return redirect('result');
    }


    public function result(Request $request)
    {
        $user_id = Auth::id(); //ユーザーIDを取得
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $punchIn = $tasks->punchIn;
        $punchOut = $tasks->punchOut;
            //ユーザーの最新のテーブルの行を取得
            //->first()だとid番号の小さいやつから1つだけ取ってくる
            //->latest()->first()でid番号が最後のやつを1つだけ取ってくる
        public fucntion diffTime($punchIn, $punchOut)
        {
            $diff = $punchOut - $punchIn;
            return gmdate('h:i', $diff);
        }

        // return view('result', compact('user_id', 'tasks', '$punchIn', '$punchOut'));
        return view('result', compact('user_id', 'tasks', '$punchIn', '$punchOut'));
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
