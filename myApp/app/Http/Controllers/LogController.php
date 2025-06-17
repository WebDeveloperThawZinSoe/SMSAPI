<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogController extends Controller
{
    //index
    public function index()
    {
        // Fetch logs from the database or any other source
        $logs = \App\Models\Log::orderBy("id","desc")->get();

        // Return the view with logs data
        return view('admin.logs.index', compact('logs'));
    }


    public function userIndex()
    {
        // Fetch logs from the database or any other source
        $logs = \App\Models\Log::where("user_id",Auth::user()->id)->orderBy("id","desc")->get();

        // Return the view with logs data
        return view('admin.logs.index', compact('logs'));
    }
}
