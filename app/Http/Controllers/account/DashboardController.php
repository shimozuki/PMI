<?php

namespace App\Http\Controllers\account;

use App\Debit;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $golb = DB::table('pendonor')->selectRaw('count(jml) as jumlah')->where('category_id', 1)->first();

        $golo = DB::table('pendonor')->selectRaw('count(jml) as jumlah')->where('category_id', 2)->first();

        $gola = DB::table('pendonor')->selectRaw('count(jml) as jumlah')->where('category_id', 3)->first();

        $golab = DB::table('pendonor')->selectRaw('count(jml) as jumlah')->where('category_id', 4)->first();


        /**
         * chart
         */

        return view('account.dashboard.index', compact('gola','golb', 'golo', 'golab'));
    }

}
