<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function add ()
    {
        return view('index');
    }
}
