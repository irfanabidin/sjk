<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Charts;
use DB;

class chartController extends Controller
{
    public function index()
    {

    	$data = DB::table('barangs')->orderBy('tgl')->get();
        $chart = Charts::create('line', 'highcharts')
        ->title('Pendapatan Laba')
    	->elementLabel("Total")
    	->dimensions(1200, 600)
    	->responsive(false)
    	->labels($data->pluck('tgl'))
    	->values($data->pluck('laba'));
    	//->groupByMonth('2017', true);

        return view('chart', ['chart' => $chart]);
    }
}
