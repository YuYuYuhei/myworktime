<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Task;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function index(Request $request) // here is top page
    {
        $dt = Carbon::now()->format("Y年m月の記録");
        // $dt =  getStrYearMonth();
        $user_id = Auth::id();  //Get user's id
        $tasks = DB::table('tasks')->get();

        $date = array();
        foreach ($tasks as $task) {
            $date[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        }
        $punchIn = array();
        foreach ($tasks as $task) {
            $punchIn[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('H:i');
        }
        $punchOut = array();
        foreach ($tasks as $task) {
            if($task->punchOut === null) {
                $punchOut[ strval($task->id) ] = "";
            } else {
                $punchOut[ strval($task->id) ] = Carbon::parse($task->punchOut)->format('H:i');
            }
        }

        return view('records.index', compact('user_id', 'dt', 'tasks', 'date', 'punchIn', 'punchOut'));
    }

    public function create() //create page of punchIn & punchOut
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $punchInTime = "";
        $punchOutTime = "";
        return view('records.create' , compact('user_id', 'punchInTime', 'punchOutTime', 'dt'));
    }

    public function storePunchIn(Request $request) // store punchIn data from create page
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id

        $punchIn = Task::create([
            'user_id' => $user_id,
            'punchIn' => Carbon::now(),
        ]);
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $diff = "";
        return view('records.create',
                       compact('dt', 'user_id', 'punchIn', '$tasks', 'punchInTime', 'punchOutTime', 'diff'));
    }

    public function storePunchOut(Request $request) // store punchOut data from create page
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $tasks = Task::where('user_id', $user_id)->latest()->first();

        $tasks->punchOut = Carbon::now();
        $diff = $this->diffTime($tasks->punchIn, $tasks->punchOut);
        $tasks->workTime = $diff;
        $tasks->save();

        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $memo = $tasks->memo;
        $workTime = $tasks->workTime;

        return view('records.create',
                       compact('dt', 'user_id', 'tasks', '$punchOut', 'punchInTime', 'punchOutTime', 'memo', 'diff', 'workTime'));
    }

    public function storeMemo(Request $request) // store Memo
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $tasks = Task::where('user_id', $user_id)->latest()->first();
        $tasks->memo = $request->memo;
        //動的にデータを処理している..はず
        // Task::update([ memo=... ])はstatic的な方法なのでここではエラーになる
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $tasks->save();

        return redirect('/');
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
        return view('records.create', compact('user_id','tasks', 'punchOutTime'));
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
    public function diffTime($punchIn, $punchOut) //ここでの引数はテーブルとの接続をとりあえず意識せずともOK
    {
        $start = strtotime($punchIn); //strtotime→これで数値化することによって計算できる
        $end = strtotime($punchOut); //この関数を$start,$endなどと代入してやらないといけない
        $diff = $end- $start;
        // return gmdate('h:i', $diff); //この計算式を適用したいAction内で使う
        return gmdate('H:i', $diff); //この計算式を適用したいAction内で使う
    }
}
