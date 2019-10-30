<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
	public function users()
	{
		$userlist=DB::table('users')->get();
		return view('user.user')->with(['users'=>$userlist]);
	}
	public function addUser(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => ['required', 'string', 'min:3', 'confirmed'],
		]);

		$user=new User;
		$user->name=$request->name;
		$user->last_name=$request->last_name;
		$user->email=$request->email;
		$user->password=Hash::make($request->password);
		$user->type=$request->type;
		$user->mobile=$request->mobile;
		$user->save();
		session()->flash('msg', 'A new user Added successfully');
		return redirect()->route('users');
	}

	public function delUser($id){
		DB::table('users')->where('id',$id)->delete();
		session()->flash('delmsg','An user deleted successfully');
		return redirect()->route('users');
	}
	public function editUser($id)
	{
		$userinfos=DB::table('users')->where('id',$id)->get();
		return view('user.editUser')->with(['userinfos'=>$userinfos]);
	}
	public function updateUser(Request $request)
	{
		DB::table('users')->where('id',$request->id)
		->update(['name'=>$request->name,'last_name'=>$request->last_name,'email'=>$request->email,'type'=>$request->type,'mobile'=>$request->mobile]);
		return redirect()->route('users');
	}
}
