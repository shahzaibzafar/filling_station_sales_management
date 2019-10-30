<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\ProductPrice;
use App\Inventory;
use App\SalesRecord;
use App\Sales;
use App\Expenses;

class ProductController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
	public function products()
	{
		$productLists=DB::table('products')
		->join('product_prices','product_prices.pro_id','=','products.id')
		->select('products.*','product_prices.buy_price', 'product_prices.retail_price', 'product_prices.wholesale_price')
		->get();

		return view('product.product')->with(['productLists'=>$productLists]);
	}

	public function add_product(Request $request)
	{

		$validatedData = $request->validate([
			'product_name' => 'required',
			'retail_price' => 'required',
			'buy_price'=>'required',
		]);
		$product=new Products;
		$product->product_name=$request->product_name;
		$product->save();

		$proPrice=new ProductPrice;
		$proPrice->pro_id=$product->id;
		$proPrice->buy_price=$request->buy_price;
		$proPrice->retail_price=$request->retail_price;
		$proPrice->wholesale_price=$request->wholesale_price;
		$proPrice->save();

		$inventory=new Inventory;
		$inventory->proid=$product->id;
		$inventory->save();
		session()->flash('msg',$product->product_name.' Added successfully');
		return redirect()->route('products');
	}

	public function delete_product($proid)
	{
		DB::table('products')->where('id',$proid)->delete();
		DB::table('product_prices')->where('pro_id',$proid)->delete();
		session()->flash('delmsg','One product deleted successfully');
		return redirect()->route('products');
	}

	public function inventory()
	{
		$productLists=DB::table('products')->get();
		$inventoryInfo=DB::table('products')
		->join('inventories','inventories.proid','=','products.id')
		->select('products.*','inventories.remain_ammount','inventories.last_input')
		->get();
		return view('product.inventory')->with(['inventoryInfo'=>$inventoryInfo,'productLists'=>$productLists]);
	}
	public function addInventory(Request $request)
	{
		$remain_ammount=DB::table('inventories')->where('proid',$request->proid)->value('remain_ammount');
		$modufyAmmount=$remain_ammount+$request->last_input;
		DB::table('inventories')->where('proid',$request->proid)
		->update(['remain_ammount'=>$modufyAmmount,'last_input'=>$request->last_input]);
		session()->flash('msg','Product added to inventory successfully');
		return redirect()->route('inventory');
		
	}
	public function getProPrice($proid)
	{
		$proPrice=DB::table('product_prices')->where('pro_id',$proid)->get();
		//return $proPrice;
		// $proid=input::get('proid');
		return response()->json($proPrice);
	}
	public function updatePrice(Request $request)
	{

		$validatedData = $request->validate([
			'proid' => 'required',
		]);
		DB::table('product_prices')->where('pro_id',$request->proid)
		->update(['buy_price'=>$request->buy_price,'retail_price'=>$request->Retail,'wholesale_price'=>$request->Wholesale]);
		session()->flash('upmsg','Product price update successfully');
		return redirect()->route('products');
	}

	public function sales()
	{
		$allproducts=DB::table('products')
		->join('product_prices','product_prices.pro_id','=','products.id')
		->select('products.*','product_prices.wholesale_price','product_prices.retail_price','product_prices.buy_price')
		->get();
		$salesentry=DB::table('sales_records')->
		get()->unique('salesid');
		return view('sales.sales')->with(['allproducts'=>$allproducts,'salesentry'=>$salesentry]);
	}
	public function delrecord($salesid)
	{
		$salesrecord=DB::table('sales_records')->where('salesid',$salesid)->get();
		foreach($salesrecord as $sales){
			$proid=$sales->proid;
			$qty=$sales->qty;
			$stock=DB::table('inventories')->where('proid',$proid)->value('remain_ammount');
			$upstock=$qty+$stock;
			DB::table('inventories')->where('proid',$proid)->update(['remain_ammount'=>$upstock]);
		}
		DB::table('sales_records')->where('salesid',$salesid)->delete();
		DB::table('expenses')->where('salesid',$salesid)->delete();
		DB::table('sales')->where('sales_date',$salesid)->delete();

		session()->flash('message','Record deleted successfully');
		session()->flash('type','success');
		return redirect()->route('sales');
	}
	public function addDailySales(Request $request)
	{
		$data = $request->all();
		$validatedData = $request->validate([
			'sales_date' => 'required',
		]);
		if (Sales::where('sales_date',$request->sales_date)->exists()) {
			session()->flash('message','Record is already exists');
			session()->flash('type','danger');
			return redirect()->back();
		}

		$sales=new Sales;
		$sales->creator=$request->creator;
		$sales->due=$request->due;
		$sales->return_due=$request->return_due;
		$sales->note=$request->note;
		$sales->sales_date=$request->sales_date;
		$sales->save();

		foreach($request->rid as $item=>$value){
			$stock=DB::table('inventories')->where('proid',$request->rid[$item])->value('remain_ammount');
			$remain_ammount=$stock-$request->rqty[$item];
			DB::table('inventories')->where('proid',$request->rid[$item])->update(['remain_ammount'=>$remain_ammount]);
			
			$retailSales=array(
				'salesid'=>$request->sales_date,
				'proid'=>$request->rid[$item],
				'buyprice'=>$request->rbuy[$item],
				'sellprice'=>$request->rsell[$item],
				'qty'=>$request->rqty[$item],
				'revenue'=>$request->rsell[$item]-$request->rbuy[$item],
				'subtotal'=>($request->rsell[$item]-$request->rbuy[$item])*$request->rqty[$item],
				'type'=>"retail"

			);
			SalesRecord::insert($retailSales);
		};
		foreach($request->wid as $item=>$value){
			$stock=DB::table('inventories')->where('proid',$request->wid[$item])->value('remain_ammount');
			$remain_ammount=$stock-$request->wqty[$item];
			DB::table('inventories')->where('proid',$request->wid[$item])->update(['remain_ammount'=>$remain_ammount]);
			$wholeSales=array(
				'salesid'=>$request->sales_date,
				'proid'=>$request->wid[$item],
				'buyprice'=>$request->wbuy[$item],
				'sellprice'=>$request->wsell[$item],
				'qty'=>$request->wqty[$item],
				'revenue'=>$request->wsell[$item]-$request->wbuy[$item],
				'subtotal'=>($request->wsell[$item]-$request->wbuy[$item])*$request->wqty[$item],
				'type'=>"wholesales"

			);
			SalesRecord::insert($wholeSales);
		};
		
		if(count($request->expense)>0){
			foreach($request->expense as $item=>$value){
				$expense=array(
					'salesid'=>$request->sales_date,
					'expense'=>$request->expense[$item],
					'cost'=>$request->cost[$item],



				);
				Expenses::insert($expense);
			};
		}
		session()->flash('message','Record added successfully');
		session()->flash('type','success');
		return redirect()->route('sales');
		
	}

	public function viewrecord($date)
	{
		$retailSales=DB::table('sales_records')
		->join('products','products.id','=','sales_records.proid')
		->where('sales_records.salesid',$date)
		->where('sales_records.type','retail')
		->select(['sales_records.*','products.product_name'])
		->get();

		$wholeSales=DB::table('sales_records')
		->join('products','products.id','=','sales_records.proid')
		->where('sales_records.salesid',$date)
		->where('sales_records.type','wholesales')
		->select(['sales_records.*','products.product_name'])
		->get();

		$expenses=DB::table('expenses')
		->where('salesid',$date)
		->get();
		$note=DB::table('sales')
		->where('sales_date',$date)
		->value('note');
		$due=DB::table('sales')->where('sales_date',$date)->select(DB::raw('SUM(due) AS due'), DB::raw('SUM(return_due) AS return_due',''))->get();
		foreach($due as $du){
			$due=$du->due;
			$return_due=$du->return_due;
		}
		$summery=DB::table('sales_records')->where('salesid',$date)->select(DB::raw('SUM(sellprice * qty) AS total_sell'))->get();
		foreach($summery as $sum){
			$total_sell=$sum->total_sell;

		}

		return view('sales.viewsales')->with([

			'due'=>$due,
			'date'=>$date,
			'note'=>$note,
			'return_due'=>$return_due,
			'expenses'=> $expenses,
			'wholeSales'=>$wholeSales,
			'retailSales'=>$retailSales

		]);
	}
}
