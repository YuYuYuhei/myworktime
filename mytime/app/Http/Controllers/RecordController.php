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
        $tasks->workTimeInt = $diff;
        $tasks->save();
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $memo = $tasks->memo;
        $workTimeInt = $tasks->workTimeInt;
        return view('records.create',
                       compact('dt', 'user_id', 'tasks', '$punchOut', 'punchInTime', 'punchOutTime', 'memo', 'diff', 'workTimeInt'));
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

        $workTimeInt = $this->workTimeDisplay($task->workTimeInt);

        // foreach ($tasks as $task) {
        //     $diff = $this->diffTime($task->punchIn, $task->punchOut);
        // }

        // $punchIn = array();
        // foreach ($tasks as $task) {
        //     $punchIn[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('m/d  H:i');
        // }
        // $punchOut = array();
        // foreach ($tasks as $task) {
        //     if($task->punchOut === null) {
        //         $punchOut[ strval($task->id) ] = "";
        //     } else {
        //         $punchOut[ strval($task->id) ] = Carbon::parse($task->punchOut)->format('m/d H:i');
        //     }
        // }
        // $punchIn = array();
        // foreach ($tasks as $task) {
        //     $workTime[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('m/d  H:i');
        // }
        $sumWorkTimeInt = DB::table('tasks')->sum('workTimeInt'); // 実働時間合計

        return view('records.index', compact('user_id', 'dt', 'tasks', 'date', 'diff','punchIn', 'punchOut', 'workTimeInt', 'sumWorkTimeInt'));
    }
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        unset($task['_token']);
        return view('records.show', compact('task', 'date'));
        // ->with('task', $task);
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        return view('records.edit', compact('task', 'date'));
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        $task->punchIn = $request->punchIn;
        $task->punchOut = $request->punchOut;
        $task->memo = $request->memo;
        $task->workTimeInt = $this->diffTime($task->punchIn, $task->punchOut);
        $task->save();

        return redirect('/');
    }
    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/');
    }



    //  method to caluculate how many hours I worked
    public function diffTime($punchIn, $punchOut) //ここでの引数はテーブルとの接続をとりあえず意識せずともOK
    {
        $start = strtotime($punchIn); //strtotime→これで数値化することによって計算できる
        $end = strtotime($punchOut); //この関数を$start,$endなどと代入してやらないといけない
        return  $end- $start;
        // return gmdate('h:i', $diff); //この計算式を適用したいAction内で使う
        // return gmdate('H:i', $diff); //この計算式を適用したいAction内で使う
    }

    public function workTimeDisplay($workTimeInt)
    {
        // $tasks = DB::table('tasks')->get();
        return gmdate('H:i', $workTimeInt);
    }

    public function AAAA($workTime, $workTimeInt)
    {
        $user_id = Auth::id();  //Get user's id
        $workTime = DB::table('tasks')->sum('workTimeInt');
        $workTimeInt = strtotime($workTime);
        return gmdate('H:i', $workTimeInt);
    }


}
