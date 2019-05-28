<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Task;
use Carbon\Carbon;

class UpdateController extends Controller
{

    public function update(Request $request) {

        $user_id = Auth::id();
        $tasks = new Task;

        $showPunchIn = new Carbon($tasks->punchIn);


        return view('update', compact('user_id', 'showPunchIn'));
       }








        // $tasks = Task::find($request->punchIn);
        // $tasks = Task::find($request->memo);
        //
        // $tasks_form = $request->all();
        //
        // unset($tasks_form['_token']);
        //
        // $tasks->fill($tasks_form)->save();
        // return redirect('update');
    // }
}
