<?php

namespace App\Http\Controllers;

use App\Info_user;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\Facades\jDateTime;
use Morilog\Jalali\jDate;

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
        $user_info=Info_user::where('user_id',$id)->first();
//        dd($user_info);
        return view('Admin.Users.Edit',compact('user','roles','user_info'));
    }

    public function update(Request $request, $id)
    {
//dd($request->Role_select);
        $file = $request->file('images');
        $imagesUrl['images']['400']="no_img";
        if ($file) {
            $imagesUrl = $this->upload_profile_Images($file);
//            $imagesUrl['images']['900']
            $image_path=$imagesUrl['images']['400'];
        }else
        {
            $user_info=Info_user::where('user_id',$id)->first();
            $image_path=$user_info->imagePath;
        }
        $s_date = explode('-', $request->birthday);
        $s_date_m=jDateTime::toGregorian($s_date[0], $s_date[1], $s_date[2]); // [2016, 5, 7]
        $s_date_m=Carbon::createFromDate($s_date_m[0],$s_date_m[1],$s_date_m[2]);

        $user_info=Info_user::where('user_id',$id)->update([
            'name'=>$request->name,
            'family'=>$request->family,
            'national_code'=>$request->national_code,
            'phone_number'=>$request->phone_number,
            'mobile_number'=>$request->mobile_number,
            'country'=>$request->country,
            'province'=>$request->province,
            'city'=>$request->city,
            'address'=>$request->address,
            'postal_code'=>$request->postal_code,
            'user_email'=>$request->user_email,
            'birthday'=>$s_date_m,
            'commission'=>$request->commission,
            'seller_id'=>$request->seller_id,
            'imagePath'=>$image_path,
        ]);

        $this->validateWith([
            'u_name' => 'required|max:255',
            'u_email' => 'required|email|unique:users,email,'.$id
        ]);
        $user=User::findOrFail($id);
        $user->name=$request->u_name;
        $user->email=$request->u_email;
        if(isset($request->change_pass)){
            $password=trim($request->u_password);
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
