<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use App\Pembelians;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembeliansController extends Controller
{
    private $default_order_column = 'id';
    private $default_order_direction = 'asc';

    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $rules    = [
        //'kode'      => 'required|alpha_num',
        //'nama_pembelians' => 'required|alpha_num'
    ];
    protected $messages = [
        'required'  => 'Kolom :attribute tidak boleh kosong.',
        'alpha_num' => 'Kolom :attribute hanya boleh berisi angka & huruf.',
        'numeric'   => 'Kolom :attribute hanya boleh berisi angka.'
    ];

    public function index(Request $request)
    {
        if($request->input('json') == 'true'){
            $order_by = $request->input('column')[$request->input('order')['0']['column']]['data'];
            $order_by = empty($order_by) ? $this->default_order_column : $order_by;
            $order_dir = empty($request->input('order')['0']['dir']) ? $this->default_order_direction : $request->input('order')['0']['dir'];

            $offset = $request->input('start', 0);
            $length = $request->input('length', '18446744073709551615');
            $length = $length == -1 ? '18446744073709551615' : $length;
            
            $pembelianss = Pembelians::where('nama', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('tgl', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('stok', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('hrgpokok', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('pid', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orderBy($order_by, $order_dir)
                ->limit($length)
                ->offset($offset) 
                ->get();
            $recordsTotal = Pembelians::count();
            $recordsFiltered = Pembelians::where('nama', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('tgl', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('stok', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('hrgpokok', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('pid', 'LIKE', '%'.$request->input('search')['value'].'%')
				->count();
            $result = [
                'draw' => 0,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $pembelianss->toArray(),
            ];
            return response()->json($result);
        }
        return view('pembelians.index', compact('pembelianss', 'request'));
    }

    public function create()
    {
        $pembelians = new Pembelians();
        $option['method'] = 'POST';
        $option['url'] = route('pembelians.store');
        $option['title'] = 'Add Pembelians';
        $option['submit_text'] = 'Save';
        return view('pembelians.form',[
			'pembelians' => $pembelians,
			'option' => $option,
		]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $input = $request->all();
        Pembelians::create($input);        
        return response()->json(['success']);
        //Session::flash('success_message', 'Pembelians successfully added!');
        //return redirect()->route('pembelians.index');
    }

    public function show($id)
    {
        $pembelians = Pembelians::findOrFail($id);
        return view('pembelians.show',[
			'pembelians' => $pembelians,
		]);
    }

    public function edit($id)
    {
        $pembelians = Pembelians::findOrFail($id);
        $option['method'] = 'PATCH';
        $option['url'] = route('pembelians.update', $id);
        $option['title'] = 'Edit Pembelians';
        $option['submit_text'] = 'Update';
        return view('pembelians.form',[
			'pembelians' => $pembelians,
			'option' => $option,
		]);
    }

    public function update($id, Request $request)
    {
        $pembelians  = Pembelians::findOrFail($id);
        $input = $request->all();
        $pembelians->fill($input)->save();        
        return response()->json(['success']);
    }

    public function destroy($id)
    {
        $pembelians = Pembelians::findOrFail($id);
        $pembelians->delete();
        return response()->json(['success']);
    }
}