<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyinfo=DB::table('companies')->get();
        return view('dashboard')->with(['companyinfos'=>$companyinfo]);
    }

    public function company()
    {
        $companyinfo=DB::table('companies')->get();
        return view('company.company')->with(['companyinfos'=>$companyinfo]);
    }

    public function addcompanyinfo(Request $request)
    {
       $validatedData = $request->validate([
        'name' => 'required',
    ]);
       DB::table('companies')->where('id','1')
       ->update([
           'name'=>$request->name,
           'email'=>$request->email,
           'mobile'=>$request->mobile,
           'address'=>$request->address
       ]);
       // $company=new Company;
       // $company->name=$request->name;
       // $company->email=$request->email;
       // $company->mobile=$request->mobile;
       // $company->address=$request->address;
       // $company->update();
       //session()->flash('msg',$product->product_name.' Added successfully');
       return redirect()->route('home');
   }
}
