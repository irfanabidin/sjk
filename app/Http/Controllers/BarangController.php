<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use App\Pembelian;
use App\Tagihan;
use Auth;
use DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request)
    {
            $barangs = Barang::where('nama', 'LIKE', '%'.$request->input('q').'%')
            ->orderBy('created_at', 'asc')
            ->paginate(50);

            $jml = DB::table('barangs')->sum('laba');
            $jmltag = DB::table('tagihans')->sum('pengeluaran');
            $lababersih = $jml-$jmltag;
            


        return view('Barang.index', compact('barangs', 'request','jml','lababersih'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pembelian = Pembelian::all();
     return view('barang.create', compact('pembelian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'              => 'required',
            'tgl'             => 'required',
            'brterjual'        => 'required',
            'hrgjual'        => 'required',
            'hrgpokok'        => 'required',
        ]);

        $barang = new Barang();
        $barang->nama         = $request->nama;
        $barang->tgl        = $request->tgl;
        $barang->brterjual  = $request->brterjual;
        $barang->hrgjual        = $request->hrgjual;
        $barang->hrgpokok   = $request->hrgpokok;
        $barang->laba     = ($request->hrgjual - $request->hrgpokok) * $request->brterjual ;
        $barang->pid     = Auth::user()->id;
        $barang->save();

        $request->session()->flash('success_message', 'Berhasil menambah data!');

        return redirect()->route('barang.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $Barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $Barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $Barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $pembelian = Pembelian::all();
        return view('barang.edit', compact('barang','pembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $Barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'nama'              => 'required',
            'tgl'             => 'required',
            'brterjual'        => 'required',
            'hrgjual'        => 'required',
            'hrgpokok'        => 'required',

        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama         = $request->nama;
        $barang->tgl        = $request->tgl;
        $barang->brterjual  = $request->brterjual;
        $barang->hrgjual        = $request->hrgjual;
        $barang->hrgpokok   = $request->hrgpokok;
        $barang->laba     = ($request->hrgjual - $request->hrgpokok) * $request->brterjual ;
        $barang->pid     = Auth::user()->id;
        $barang->save();
        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $Barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Barang::destroy($id);

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('barang.index');
    }
}

