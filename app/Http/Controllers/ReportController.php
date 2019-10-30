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
use PDF;

class ReportController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
   public function report()
   {
   	return view('report.report');
   }
   public function getreport(Request $request)
   {
   	$summery=DB::table('sales_records')->whereBetween('salesid', [$request->start_date, $request->end_date])->select(DB::raw('SUM(subtotal) AS total_revenue'), DB::raw('SUM(sellprice * qty) AS total_sell'))->get();
      foreach($summery as $sum){
         $total_sell=$sum->total_sell;
         $total_revenue=$sum->total_revenue;

      }

   	$expense=DB::table('expenses')->whereBetween('salesid', [$request->start_date, $request->end_date])->select(DB::raw('SUM(cost) AS expense'))->get();
      foreach($expense as $ex){
         $expense=$ex->expense;
      }

   	$due=DB::table('sales')->whereBetween('sales_date', [$request->start_date, $request->end_date])->select(DB::raw('SUM(due) AS due'), DB::raw('SUM(return_due) AS return_due'))->get();
       foreach($due as $du){
         $due=$du->due;
         $return_due=$du->return_due;
       }
   	return view('report.viewReport')->with([
         'total_sell'=>$total_sell, 
         'total_revenue'=>$total_revenue, 
         'expense'=>$expense, 
         'due'=>$due, 
         'return_due'=>$return_due, 
         'start'=>$request->start_date, 
         'end'=>$request->end_date
      ]);
   }

   public function printreport()
   {
      return view('report.dailyreport');
   }

   public function printdata(Request $request)
   {
      $date=$request->print_date;

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
$summery=DB::table('sales_records')->where('salesid',$date)->select(DB::raw('SUM(subtotal) AS total_revenue'), DB::raw('SUM(sellprice * qty) AS total_sell'))->get();
      foreach($summery as $sum){
         $total_sell=$sum->total_sell;
         $total_revenue=$sum->total_revenue;

      }
      $pdf = PDF::loadView('report.printReport',[
          'due'=>$due,
          'date'=>$date,
          'note'=>$note,
          'total_revenue'=>$total_revenue,
          'return_due'=>$return_due,
          'expenses'=> $expenses,
          'wholeSales'=>$wholeSales,
          'retailSales'=>$retailSales
       ]);
      return $pdf->download('record.pdf');
      //return $pdf->stream('record.pdf');
      //return view('report.printReport')->with(['otherinfo'=> $otherinfo]);
      
   }
   public function printPdf()
   {
      
   }
}
