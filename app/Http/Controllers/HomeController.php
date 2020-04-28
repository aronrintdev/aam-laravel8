<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function lessonStats() {
        $res = \DB::connection('lessons')->select('select count(*) as cnt, academy_code, status from lesson
            group by academy_code, status');

        return response()->json($res);
    }
}
