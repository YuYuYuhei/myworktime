<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use Carbon\Carbon;


class RecordController extends Controller
{
    //display 新規作成ページ page
    public function index()
    {
        $user_id = Auth::id();
        //Get user's id
        //Any previous data unnecessary because it's for creating new table

        // 当アクションの残骸
        // $punchIn = Carbon::now(); //viewへのaccess時の時刻を取得
        // return view('record', compact('user_id', 'punchIn'));

        return view('record', compact('user_id'));
    }

    //store punchInTime to tasks table as punchIn column data
    public function punchIn()
    {
        $user_id = Auth::id();  //Get user's id

        $punchIn = Task::create([
            'user_id' => $user_id,
            'punchIn' => Carbon::now(),
        ]);   // store [user_id, punchIn] when push「出勤時間を記録する」at [record.blade..php]

        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $punchInTime = $tasks->punchIn;
        // get latest row from [tasks table] and punchIn Data

        // 当アクションの残骸
        // $tasks = new Task;  //Taskインスタンス作成→$tasksへ代入, この時点では空
        // $form = $request->all(); //$formにtasks tableのall dataを取得し代入
        // unset($form['_token']); //allではトークンも一緒なのでunsetで削除
        // $tasks->fill($form); //$formの内容を$tasksにfillする
        // $tasks->punchIn = Carbon::now(); //$tasksのpanchInに挿入しているFieldを上書き
        // $tasks->save(); //$tasksの中身をsaveする
        // return redirect('update');

        // return view('record', compact('user_id', 'punchIn', 'tasks', 'punchInTime'));
        return redirect()->action('RecordController@show');
    }

    //display punchIn's time(tasks table) and display finish time button
    public function show(Request $request)
    {
        $user_id = Auth::id(); // Get user's id
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $punchOut =  $tasks->punchOut;

        return view('record', compact('user_id', 'tasks', 'punchOut'));
    }


    //display punchOut's time(tasks table) and display edit button
    public function punchOut(Request $request) //ここから！！
    {
        $user_id = Auth::id(); //Get user's id
        $punchOut = Task::where('user_id', $user_id)->latest()->first();
        $punchOut->punchOut = Carbon::now();



        $tasks->save();
        return redirect('result');
    }

    public function result(Request $request)
    {
        $user_id = Auth::id(); //ユーザーIDを取得
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $diff = $this->diffTime($tasks->punchIn, $tasks->punchOut);
        // how many hours I worked
        //thisで同クラス内の関数にアクセス
        //引数部分はtaskに呼んできた行の情報をセット
    return view('result', compact('user_id', 'tasks', 'diff'));
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    //  method to caluculate how many hours I worked
    private function diffTime($punchIn, $punchOut) //ここでの引数はテーブルとの接続をとりあえず意識せずともOK
    {
        $start = strtotime($punchIn); //strtotime→これで数値化することによって計算できる
        $end = strtotime($punchOut); //この関数を$start,$endなどと代入してやらないといけない
        $diff = $end- $start;
        return gmdate('h:i', $diff); //この計算式を適用したいAction内で使う
    }
}
