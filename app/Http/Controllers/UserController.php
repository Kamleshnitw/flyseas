<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use App\Models\Admin\City;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Admin\UserDetails;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-index', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', auth()->id())->where('user_type', 'vendor')->paginate(25);
        return view('backend.users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $assigned_city = UserDetails::get(['city_id'])->pluck('city_id')->toArray();
        $citys = City::orderBy('name', 'ASC')->get();
        $roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->pluck('name','name')->all();
        return view('backend.users.create',compact('roles', 'citys', 'assigned_city'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['user_type'] = "vendor";
        $user = User::create($input);
        if($request->input('roles')){
            $user->assignRole($request->input('roles'));
        }
        $user_details = new UserDetails;
        $user_details->user_id = $user->id;
        $user_details->phone = $request->phone;
        $user_details->city_id = $request->city_id;
        $user_details->address = $request->address;
        $user_details->save();

        return redirect()->route('users.index')->with('success','User created successfully');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show',compact('user'));
    }

    public function edit($id)
    {
        $assigned_city = UserDetails::get(['city_id'])->pluck('city_id')->toArray();
        $citys = City::orderBy('name', 'ASC')->get();
        $user = User::find($id);
        $roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('backend.users.edit',compact('user', 'citys', 'roles','userRole', 'assigned_city'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        $user->UserDetails->phone = $request->phone;
        $user->UserDetails->address = $request->address;
        $user->UserDetails->city_id = $request->city_id;
        $user->UserDetails->save();
        if($request->input('roles')){

            DB::table('model_has_roles')->where('model_id',$id)->delete();
    
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
