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

        $uang_masuk_bulan_ini  = DB::table('pendonor')
            ->selectRaw('sum(jml) as nominal')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_bulan_ini = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('credit_date', Carbon::now()->year)
            ->whereMonth('credit_date', Carbon::now()->month)
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_masuk_bulan_lalu  = DB::table('pendonor')
            ->selectRaw('sum(jml) as nominal')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonths())
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_bulan_lalu = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('credit_date', Carbon::now()->year)
            ->whereMonth('credit_date', Carbon::now()->subMonths())
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_masuk_selama_ini  = DB::table('pendonor')
            ->selectRaw('sum(jml) as nominal')
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_selama_ini = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->where('user_id', Auth::user()->id)
            ->first();


        $golb = DB::table('pendonor')->selectRaw('sum(jml) as jumlah')->where('category_id', 1)->first();

        $golo = DB::table('pendonor')->selectRaw('sum(jml) as jumlah')->where('category_id', 2)->first();

        $gola = DB::table('pendonor')->selectRaw('sum(jml) as jumlah')->where('category_id', 3)->first();

        $golab = DB::table('pendonor')->selectRaw('sum(jml) as jumlah')->where('category_id', 4)->first();


        /**
         * chart
         */

        return view('account.dashboard.index', compact('gola','golb', 'golo', 'golab'));
    }

}
