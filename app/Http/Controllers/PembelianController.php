<?php

namespace App\Http\Controllers;

use App\Pembelian;
use Illuminate\Http\Request;
use Auth;

class PembelianController extends Controller
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
            $pembelians = Pembelian::where('nama', 'LIKE', '%'.$request->input('q').'%')
            ->orderBy('created_at', 'asc')
            ->paginate(50);



        return view('pembelian.index', compact('pembelians', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('pembelian.create');
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
            'hrgpokok'        => 'required',
            'stok'          => 'required',
        ]);

        $pembelian = new Pembelian();
        $pembelian->nama         = $request->nama;
        $pembelian->tgl        = $request->tgl;
        $pembelian->hrgpokok   = $request->hrgpokok;
        $pembelian->stok     = $request->stok;
        $pembelian->pid     = Auth::user()->id;
        $pembelian->save();

        $request->session()->flash('success_message', 'Berhasil menambah data!');

        return redirect()->route('pembelian.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        return view('pembelian.edit', compact('pembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'nama'              => 'required',
            'tgl'             => 'required',
            'hrgpokok'        => 'required',
            'stok'          => 'required',
        ]);

        $pembelian = Pembelian::findOrFail($id);
        $pembelian->nama         = $request->nama;
        $pembelian->tgl        = $request->tgl;
        $pembelian->hrgpokok   = $request->hrgpokok;
        $pembelian->stok     = $request->stok;
        $pembelian->pid     = Auth::user()->id;
        $pembelian->save();

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('pembelian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Pembelian::destroy($id);

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('pembelian.index');
    }
}
