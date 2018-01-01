<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Pembelian;
use App\Tagihan;
use Auth;
use Charts;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $jml = DB::table('barangs')->sum('laba');
        $jmltag = DB::table('tagihans')->sum('pengeluaran');
        $lababersih = $jml-$jmltag;


        $data = DB::table('barangs')->orderBy('tgl')->get();
        $chart = Charts::create('line', 'highcharts')
        ->title('Pendapatan Laba')
        ->elementLabel("Laba")
        ->dimensions(900, 450)
        ->responsive(false)
        ->labels($data->pluck('tgl'))
        ->values($data->pluck('laba'));
        //->groupByMonth('2017', true);

       // return view('chart', ['chart' => $chart]);
    
        return view('home', ['chart' => $chart], compact('barangs', 'request','jml','lababersih'));

    }
}
