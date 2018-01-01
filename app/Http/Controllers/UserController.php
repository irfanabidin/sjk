<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'LIKE', '%'.$request->input('q').'%')
            ->orderBy('created_at', 'asc')
            ->paginate(50);



        return view('users.index', compact('users', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name'              => 'required',
            'email'             => 'required|unique:users',
            'permission'        => 'required',
            'password'          => 'required|same:password-repeat',
            'password-repeat'   => 'required',
        ]);

        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
		$user->permission   = $request->permission;
        $user->password     = bcrypt($request->password);
        $user->save();

        $request->session()->flash('success_message', 'Berhasil menambah data!');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id)
            ],
            'password' => 'same:password-repeat',
            'password-repeat' => 'required_with:password',
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
		$user->permission   = $request->permission;
        $user->save();

        $request->session()->flash('success_message', 'Berhasil merubah data!');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        User::destroy($id);
        $request->session()->flash('success_message', 'Data berhasil dihapus.');

        return redirect()->route('user.index');
    }

  
}
