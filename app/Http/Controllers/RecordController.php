<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Task;
use Carbon\Carbon;
use DateTime;

class RecordController extends Controller
{
    public function create() //create page of punchIn & punchOut
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $punchInTime = "";
        $punchOutTime = "";
        return view('records.create' , compact('dt', 'punchInTime', 'punchOutTime'));
    }

    public function storePunchIn(Request $request) // store punchIn data from create page
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $punchIn = Task::create([
            'user_id' => $user_id,
            'punchIn' => Carbon::now(),
        ]);
        $tasks = Task::where('user_id', $user_id)
                       ->latest()
                       ->first();
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $diff = "";
        return view('records.create', compact('dt', 'punchInTime', 'punchOutTime'));
    }

    public function storePunchOut(Request $request) // store punchOut data from create page
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $tasks = Task::where('user_id', $user_id)
                        ->latest()
                        ->first();
        $tasks->punchOut = Carbon::now();
        $diff = $this->diffTime($tasks->punchIn, $tasks->punchOut); //aaaa
        // $tasks->workTimeInt = $diff;
        $tasks->save();
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        // $workTimeInt = $tasks->workTimeInt;
        return view('records.create',
                      compact('dt', 'diff', 'punchInTime', 'punchOutTime', 'workTimeInt'));
    }

    public function storeMemo(Request $request) // store Memo
    {
        $dt = Carbon::now()->format("Y年m月d日の記録");
        $user_id = Auth::id();  //Get user's id
        $tasks = Task::where('user_id', $user_id)
                        ->latest()
                        ->first();
        $punchInTime = $tasks->punchIn;
        $punchOutTime = $tasks->punchOut;
        $diff = $this->diffTime($tasks->punchIn, $tasks->punchOut);

        $tasks->breakIn = $request->breakIn;
        $tasks->breakOut = $request->breakOut;
        $diffBreak = $this->diffBreakTime($tasks->breakIn, $tasks->breakOut);
        $tasks->breakTimeInt = $diffBreak;
        $tasks->workTimeInt = $diff - $diffBreak;

        $tasks->memo = $request->memo;
        //動的にデータを処理している..はず
        // Task::update([ memo=... ])はstatic的な方法なのでここではエラーになる
        $tasks->save();
        return redirect('/');
    }

    public function index(Request $request) // here is top page
    {
        $user_id = Auth::id();
        if((isset($request->year)) && (isset($request->month)))
        {
            $year = $request->year;
            $month = $request->month;
        } else {
            $year = Carbon::now()->format('Y');//今日の年
            $month = Carbon::now()->format('m'); //今日の月
        }

        $dt = "今月の記録(".$year."年".$month."月)";
        $date = (new Carbon($year."-".$month))->subMonth();
        $prevYear = $date->format('Y'); //前の年
        $prevMonth = $date->format('m'); //前の月
        $date = (new Carbon($year."-".$month))->addMonth();
        $nextYear = $date->format('Y'); //翌年
        $nextMonth = $date->format('m'); //翌月
        $date = new Carbon($year."-".$month);
        $y = $date->format('Y');
        $m = $date->format('m');

        $tasks = Task::where('user_id', $user_id)
                          ->whereYear('punchIn', '=', $year)
                          ->whereMonth('punchIn', '=', $month)
                          ->get();
        $date = array();
        $sumWorkTimeInt = 0;
        foreach ($tasks as $task) {
            $date[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
            $date2[ strval($task->id) ] = Carbon::parse($task->punchIn)->format('Y/m');
            $task->punchIn = Carbon::parse($task->punchIn)->format('Y/m/d H:i');
            $task->punchOut = Carbon::parse($task->punchOut)->format('Y/m/d H:i');
            if (isset($task->breakTimeInt))
            {
                $task->breakTimeInt = Carbon::parse($task->breakTimeInt)->format('H:i');
            }
            $task->workTimeInt  = $this->workTimeDisplay($task->workTimeInt);
        }

        $dayOfWork = array_unique($date); //array_uniqueで重複を削除し日数を計算！
        $sumWorkTimeInt = Task::where('user_id', $user_id)
                                ->whereYear('punchIn', '=', $year)
                                ->whereMonth('punchIn', '=', $month)
                                ->sum('workTimeInt'); // 該当月の実働時間合計



        $links = Task::where('user_id', $user_id)
                 ->get();
        foreach($links as $link)
        {
            $temp = Carbon::parse($link->punchIn)->format('Y-m'); //データベースのpunchinをforeachで回しY-mで取得
            $yearMonth[] = $temp;
            // $strYearMonth = string date('Y-m', $temp);
            // \Debugbar::info($link->punchIn);
        }
         $linkYearMonths = array_unique($yearMonth); //データの重複をarray_uniqueで排除
         rsort($linkYearMonths); //並び替え
         // list($year, $month) = preg_split('/[-]/', $linkYearMonths);
         foreach($linkYearMonths as $linkYearMonth) //とってきたY-mデータ値を更にforeachで回す
         {
             $explodeYearMonths[] = explode("-", $linkYearMonth); //年月をexplodeで分割し配列に入れる
         }
         // \Debugbar::info($explodeYearMonths);
         return view('records.index',
                         compact('dt', 'prevYear','prevMonth', 'nextYear', 'nextMonth', 'tasks', 'date', 'sumWorkTimeInt', 'dayOfWork', 'linkYearMonths', 'explodeYearMonths'));
    }

    public function show(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        $task->punchIn = Carbon::parse($task->punchIn)->format('Y/m/d H時i分');
        $task->punchOut = Carbon::parse($task->punchOut)->format('Y/m/d H時i分');
        $breakTime = Carbon::parse($task->breakTimeInt)->format('H時間i分');
        $workTime = Carbon::parse($task->workTimeInt)->format('H時間i分');

        unset($task['_token']);
        return view('records.show', compact('task', 'date', 'breakTime', 'workTime'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        $breakTime = Carbon::parse($task->breakTimeInt)->format('H時間i分');
        $workTime = Carbon::parse($task->workTimeInt)->format('H時間i分');
        return view('records.edit', compact('task', 'date', 'breakTime', 'workTime'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $date = Carbon::parse($task->punchIn)->format('Y/m/d(D)');
        $task->punchIn = $request->punchIn;
        $task->punchOut = $request->punchOut;
        $task->breakIn = $request->breakIn;
        $task->breakOut = $request->breakOut;
        $task->memo = $request->memo;

        $diff = $this->diffTime($task->punchIn, $task->punchOut);
        $diffBreak = $this->diffBreakTime($task->breakIn, $task->breakOut);

        $task->breakTimeInt = $diffBreak;
        $task->workTimeInt = $diff - $diffBreak;

        // $task->workTimeInt = $this->diffBreakTime($task->punchIn, $task->punchOut, $task->breakTime);
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
        return  $end - $start;
        // return gmdate('h:i', $diff); //この計算式を適用したいAction内で使う
    }

    public function diffBreakTime($breakIn, $breakOut)
    {
        $breakIn = strtotime($breakIn);
        $breakOut = strtotime($breakOut);
        return $breakOut - $breakIn;
    }

    public function workTimeInt($diff, $breakTimeInt)
    {
        $workTime = strtotime($diff);
        $breakTime = strtotime($breakTimeInt);
        return  $workTime - $breakTime;
    }

    public function workTimeDisplay($workTimeInt)
    {
        return gmdate('H:i', $workTimeInt);
    }

}
