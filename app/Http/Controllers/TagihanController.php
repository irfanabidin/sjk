<?php

namespace App\Http\Controllers;

use App\Tagihan;
use Illuminate\Http\Request;
use Auth;
use DB;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
         $tagihan = Tagihan::where('notag', 'LIKE', '%'.$request->input('q').'%')
            ->orderBy('created_at', 'asc')
            ->paginate(50);

            $jmltag = DB::table('tagihans')->sum('pengeluaran');

        return view('tagihan.index', compact('tagihan', 'request','jmltag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('tagihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $this->validate($request, [
            'notag'              => 'required',
            'tgl'             => 'required',
            'jenistag'        => 'required',
            'pengeluaran'          => 'required',
          
        ]);

        $tagihan = new Tagihan();
        $tagihan->notag         = $request->notag;
        $tagihan->tgl        = $request->tgl;
        $tagihan->jenistag   = $request->jenistag;
        $tagihan->pengeluaran     = $request->pengeluaran;
        $tagihan->pid     = Auth::user()->id;
        $tagihan->save();

        $request->session()->flash('success_message', 'Berhasil menambah data!');

        return redirect()->route('tagihan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tagihan  $tagihantagihan
     * @return \Illuminate\Http\Response
     */
    public function show(Tagihan $tagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagihan $tagihan)
    {
        //
        $tagihan = Tagihan::findOrFail($id);
        return view('tagihan.edit', compact('tagihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        //
        $this->validate($request, [
            'notag'              => 'required',
            'tgl'             => 'required',
            'jenistag'        => 'required',
            'pengeluaran'          => 'required',
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->notag         = $request->notag;
        $tagihan->tgl        = $request->tgl;
        $tagihan->jenistag   = $request->jenistag;
        $tagihan->pengeluaran     = $request->pengeluaran;
        $tagihan->pid     = Auth::user()->id;
        $tagihan->save();

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('tagihan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
         Tagihan::destroy($id);

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('tagihan.index');
    }
}
