<?php

namespace App\Http\Controllers;
use App\Models\Catogory;
use App\Models\SubCatogory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $units = Unit::all();
        return view('admin.product.create',compact('categories','subcategories','brands','sizes','colors','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product =new Product();
        $product->cat_id = $request->category; 
        $product->subcat_id = $request->subcategory; 
        $product->br_id = $request->brand; 
        $product->unit_id = $request->unit; 
        $product->size_id = $request->size; 
        $product->color_id = $request->color; 
        $product->code = $request->code; 
        $product->name = $request->name; 
        $product->description = $request->description; 
        $product->price = $request->price; 

        $images = array();
        if($files =$request->file('file')){
            $i = 0;
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $fileNameExtract = explode('.',$name);
                $filename =  $fileNameExtract[0];
                $filename.=time();
                $filename.=$i;
                $filename.='.';
                $filename.=$fileNameExtract[1];
                $file->move('image',$filename);
                $images[]=$filename;
                $i++;

            }
            
            $product['image']=implode("|",$images);
            $product ->save();
            return redirect()->back()->with('message','Product added');
        }else{
            echo "error";
        }

        
        $product ->save();
        
        return redirect()->back()->with('message','SubCategory added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Product $product)
    {
      if($product->status==1){
        $product->update(['status'=>0]);
        }
       else{
        $product->update(['status'=>1]);
        }
       return redirect()->back()->with('message','product Status changed');
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Catogory::all();
        $subcategories = SubCatogory::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $units = Unit::all();
        return view('admin.product.edit',compact('product','categories','subcategories','brands','sizes','colors','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       $size = explode(",",$request->size);
       $color = explode(",",$request->color);
        $update = $product->update([

            'code' =>  $request->code,
            'name' =>  $request->name,
            'cat_id' =>  $request->category,
            'subcat_id' =>  $request->subcategory,
            'br_id' =>  $request->brand,
            'unit_id' =>  $request->unit,
            'size_id' =>  (int) json_encode($size),
            'color_id' =>  (int) json_encode($color),

            'description' => $request->description,
            'price' => $request->price,
        ]);
        if($update)
   
       return redirect('/products')->with('message','Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $delete = $product->delete();

       if($delete)
     
       return redirect()->back()->with('message','Product deleted');
    }
}
