<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use App\@MODEL@;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class @MODEL@Controller extends Controller
{
    private $default_order_column = '@ORDER_COLUMN@';
    private $default_order_direction = '@ORDER_DIRECTION@';

    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $rules    = [
        //'kode'      => 'required|alpha_num',
        //'nama_@INSTANCE@' => 'required|alpha_num'
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
            
            $@INSTANCE@s = @MODEL@::@COLUMNS_SEARCH@
                ->orderBy($order_by, $order_dir)
                ->limit($length)
                ->offset($offset) 
                ->get();
            $recordsTotal = @MODEL@::count();
            $recordsFiltered = @MODEL@::@COLUMNS_SEARCH@
				->count();
            $result = [
                'draw' => 0,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $@INSTANCE@s->toArray(),
            ];
            return response()->json($result);
        }
        return view('@INSTANCE@.index', compact('@INSTANCE@s', 'request'));
    }

    public function create()
    {
        $@INSTANCE@ = new @MODEL@();
        $option['method'] = 'POST';
        $option['url'] = route('@INSTANCE@.store');
        $option['title'] = 'Add @MODEL@';
        $option['submit_text'] = 'Save';
        return view('@INSTANCE@.form',[
			'@INSTANCE@' => $@INSTANCE@,
			'option' => $option,
		]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $input = $request->all();
        @MODEL@::create($input);        
        return response()->json(['success']);
        //Session::flash('success_message', '@MODEL@ successfully added!');
        //return redirect()->route('@INSTANCE@.index');
    }

    public function show($id)
    {
        $@INSTANCE@ = @MODEL@::findOrFail($id);
        return view('@INSTANCE@.show',[
			'@INSTANCE@' => $@INSTANCE@,
		]);
    }

    public function edit($id)
    {
        $@INSTANCE@ = @MODEL@::findOrFail($id);
        $option['method'] = 'PATCH';
        $option['url'] = route('@INSTANCE@.update', $id);
        $option['title'] = 'Edit @MODEL@';
        $option['submit_text'] = 'Update';
        return view('@INSTANCE@.form',[
			'@INSTANCE@' => $@INSTANCE@,
			'option' => $option,
		]);
    }

    public function update($id, Request $request)
    {
        $@INSTANCE@  = @MODEL@::findOrFail($id);
        $input = $request->all();
        $@INSTANCE@->fill($input)->save();        
        return response()->json(['success']);
    }

    public function destroy($id)
    {
        $@INSTANCE@ = @MODEL@::findOrFail($id);
        $@INSTANCE@->delete();
        return response()->json(['success']);
    }
}