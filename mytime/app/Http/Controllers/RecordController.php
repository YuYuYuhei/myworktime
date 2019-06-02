<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        //Get user's id  //Any previous data unnecessary because it's for creating new table
        return view('records.create', compact('user_id'));
    }
    //store punchInTime to tasks table as punchIn(create) column data
    public function punchIn()
    {
        $user_id = Auth::id();  //Get user's id
        $punchIn = Task::create([
            'user_id' => $user_id,
            'punchIn' => Carbon::now(),
        ]);   // store [user_id, punchIn] when push「出勤時間を記録する」at [record.blade..php]
        // $tasks = Task::where('user_id', $user_id)->latest()->first();
        // $punchInTime = $tasks->punchIn;  // get latest row from [tasks table] and punchIn Data

        return view('records.create', compact('user_id', 'punchIn', 'tasks', 'punchInTime'));
        // return redirect()->action('RecordController@edit');
    }
    // display punchIn's time(tasks table) and display finish time button
    public function show(Request $request)
    {
        $user_id = Auth::id(); // Get user's id
        $tasks = Task::where('user_id', $user_id)->latest()->first();

        $punchInTime = $tasks->punchIn;
        $punchOut =  $tasks->punchOut;
        return view('records.create', compact('user_id', 'tasks', 'punchOut'));
    }
    //display punchOut's time(tasks table) and display edit button
    public function punchOut(Request $request) //ここから！！
    {
        $user_id = Auth::id(); //Get user's id
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $tasks->punchOut = Carbon::now();
        $punchOutTime = $tasks->punchOut;
        // $tasks->save();
        return redirectview('records.create', compact('user_id','tasks', 'punchOutTime'));
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
