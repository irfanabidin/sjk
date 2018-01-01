<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use App\Contohs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContohsController extends Controller
{
    private $default_order_column = 'id';
    private $default_order_direction = 'asc';

    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $rules    = [
        //'kode'      => 'required|alpha_num',
        //'nama_contohs' => 'required|alpha_num'
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
            
            $contohss = Contohs::where('id', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('name', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('ini', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orderBy($order_by, $order_dir)
                ->limit($length)
                ->offset($offset) 
                ->get();
            $recordsTotal = Contohs::count();
            $recordsFiltered = Contohs::where('id', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('name', 'LIKE', '%'.$request->input('search')['value'].'%')
                ->orWhere('ini', 'LIKE', '%'.$request->input('search')['value'].'%')
				->count();
            $result = [
                'draw' => 0,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $contohss->toArray(),
            ];
            return response()->json($result);
        }
        return view('contohs.index', compact('contohss', 'request'));
    }

    public function create()
    {
        $contohs = new Contohs();
        $option['method'] = 'POST';
        $option['url'] = route('contohs.store');
        $option['title'] = 'Add Contohs';
        $option['submit_text'] = 'Save';
        return view('contohs.form',[
			'contohs' => $contohs,
			'option' => $option,
		]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $input = $request->all();
        Contohs::create($input);        
        return response()->json(['success']);
        //Session::flash('success_message', 'Contohs successfully added!');
        //return redirect()->route('contohs.index');
    }

    public function show($id)
    {
        $contohs = Contohs::findOrFail($id);
        return view('contohs.show',[
			'contohs' => $contohs,
		]);
    }

    public function edit($id)
    {
        $contohs = Contohs::findOrFail($id);
        $option['method'] = 'PATCH';
        $option['url'] = route('contohs.update', $id);
        $option['title'] = 'Edit Contohs';
        $option['submit_text'] = 'Update';
        return view('contohs.form',[
			'contohs' => $contohs,
			'option' => $option,
		]);
    }

    public function update($id, Request $request)
    {
        $contohs  = Contohs::findOrFail($id);
        $input = $request->all();
        $contohs->fill($input)->save();        
        return response()->json(['success']);
    }

    public function destroy($id)
    {
        $contohs = Contohs::findOrFail($id);
        $contohs->delete();
        return response()->json(['success']);
    }
}