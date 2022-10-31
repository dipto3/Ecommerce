<?php

namespace App\Http\Controllers;



namespace App\Http\Controllers;
use App\Models\Catogory;
use App\Models\SubCatogory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Unit;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $units = Unit::all();
        $products= Product::where('status',1)->latest()->limit(12)->get();

        $top_sales = DB::table('products')
            ->leftJoin('order_details','products.id','=','order_details.product_id')
            ->selectRaw('products.id, SUM(order_details.product_sales_quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }

        return view('frontend.welcome',compact('products','categories','subcategories','brands','sizes','colors','units','topProducts'));
    }
    
    public function view_details($id){
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $product= Product::findOrFail($id);
        $sizes = Size::find($product->size_id);
        $colors = Color::find($product->color_id);
        $units = Unit::all();
        $cat_id = $product->cat_id;
        $releted_products = Product::where('cat_id',$cat_id)->limit(4)->get();
        return view('frontend.pages.view_details',compact('product','categories','subcategories','brands','sizes','colors','units','releted_products'));
        

    }

    public function product_by_cat($id){
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $products= Product::where('status',1)->where('cat_id',$id)->limit(12)->get();

        $top_sales = DB::table('products')
        ->leftJoin('order_details','products.id','=','order_details.product_id')
        ->selectRaw('products.id, SUM(order_details.product_sales_quantity) as total')
        ->groupBy('products.id')
        ->orderBy('total','desc')
        ->take(8)
        ->get();
    $topProducts = [];
    foreach ($top_sales as $s){
        $p = Product::findOrFail($s->id);
        $p->totalQty = $s->total;
        $topProducts[] = $p;
    }
        return view('frontend.pages.product_by_cat',compact('products','categories','subcategories','brands','topProducts'));
    }

    public function product_by_subcat($id){
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $products= Product::where('status',1)->where('subcat_id',$id)->limit(12)->get();

        $top_sales = DB::table('products')
        ->leftJoin('order_details','products.id','=','order_details.product_id')
        ->selectRaw('products.id, SUM(order_details.product_sales_quantity) as total')
        ->groupBy('products.id')
        ->orderBy('total','desc')
        ->take(8)
        ->get();
    $topProducts = [];
    foreach ($top_sales as $s){
        $p = Product::findOrFail($s->id);
        $p->totalQty = $s->total;
        $topProducts[] = $p;
    }

        return view('frontend.pages.product_by_subcat',compact('products','categories','subcategories','brands','topProducts'));
    }

    public function product_by_brand($id){
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $products= Product::where('status',1)->where('br_id',$id)->limit(12)->get();

        $top_sales = DB::table('products')
        ->leftJoin('order_details','products.id','=','order_details.product_id')
        ->selectRaw('products.id, SUM(order_details.product_sales_quantity) as total')
        ->groupBy('products.id')
        ->orderBy('total','desc')
        ->take(8)
        ->get();
    $topProducts = [];
    foreach ($top_sales as $s){
        $p = Product::findOrFail($s->id);
        $p->totalQty = $s->total;
        $topProducts[] = $p;
    }
        return view('frontend.pages.product_by_brand',compact('products','categories','subcategories','brands','topProducts'));
    }

    public function search(Request $request){
        $products = Product::orderBy('id','desc')->where('name','LIKE','%'.$request->product.'%');

        if($request->category!= "ALL")$products->where('cat_id',$request->category);

        $products = $products-> get();
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        
        return view('frontend.pages.product_by_cat',compact('products','categories','subcategories','brands'));
    }
}