<?php

namespace App\Http\Controllers;

use App\Models\Catogory;
use App\Models\SubCatogory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCatogory::all();
        return view('admin.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Catogory::all();
        return view('admin.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory =new SubCatogory();
        $subcategory->cat_id = $request->category; 
        $subcategory->name = $request->name; 
        $subcategory->description = $request->description; 

        
        $subcategory ->save();
        
        return redirect()->back()->with('message','SubCategory added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(SubCatogory $subcategory)
    {
      if($subcategory->status==1){
        $subcategory->update(['status'=>0]);
        }
       else{
        $subcategory->update(['status'=>1]);
        }
       return redirect()->back()->with('message','SubCategory Status changed');
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCatogory $subCategory)
    {
        $categories = Catogory::all();
        return view('admin.subcategory.edit',compact('categories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCatogory $subCategory)
      {

      
  
           $update = $subCategory->update([

              'name' =>  $request->name,
              'cat_id' =>  $request->category,
              'description' => $request->description,
           
          ]);
          if($update)
     
         return redirect('/sub-categories')->with('message','Category updated');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCatogory $subCategory)
    {
       $delete = $subCategory->delete();

       if($delete)
     
       return redirect()->back()->with('message','Category deleted');
    }
}
