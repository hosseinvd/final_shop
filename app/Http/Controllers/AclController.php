<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AclController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('created_at', 'desc')->paginate(10);
        $roles=Role::all();
        return view('Admin.Users.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('Admin.Users.Create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users'
        ]);
        $password=trim($request->password);

        $user=User::create([
            'name' => $request->name,
            'user_name'=>$request->email,
            'email'=>$request->email,
            'password' => Hash::make($password),
        ]);
        $info_user = \App\Info_user::create([
            'user_id'=>$user->id,
            'name'=>$request->name,
            'family'=>$request->name,
            'national_code'=>1,
            'phone_number'=>1,
            'mobile_number'=>1,
            'country'=>'IRAN',
            'province'=>'',
            'city'=>'',
            'address'=>'',
            'postal_code'=>'',
            'user_email'=>$request->email,
            'birthday'=>now(),
            'imagePath'=>'',
            'seller_id'=>'1',
            'commission'=>'0'
        ]);

        return redirect()->route('users.show',$user->id);

    }

    public function show($id)
    {
        $user = User::where('id', $id)->with('roles','info_user')->first();
        return view('Admin.users.show',compact('user'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('id', $id)->with('roles')->first();
        return view('Admin.Users.Edit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
//dd($request->Role_select);
        $this->validateWith([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $user=User::findOrFail($id);
        $user->name=$request->name;
        $user->email=$request->email;
        if(isset($request->change_pass)){
            $password=trim($request->password);
            $user->password=Hash::make($password);
        }
        $user->save();
        if ($request->Role_select) {
            $user->syncRoles($request->Role_select);
        }
        if($user->save()){
            return redirect()->route('users.show',$user->id);
        }else{
            Session::flash('danger','Sorry a problem occurred while creating this user.');
            return redirect()->route('users.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
