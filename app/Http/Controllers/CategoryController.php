<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Models\Catogory;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Catogory::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category =new Catogory;
        $category->id = $request->category; 
        $category->name = $request->name; 
        $category->description = $request->description; 

        if($request -> hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('category', $filename);
            $category->image = $filename;
            
        }
        $category ->save();
        
        return redirect()->back()->with('message',"Category added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function change_status(Catogory $category)
     {
       if($category->status==1){
            $category->update(['status'=>0]);
         }
        else{
             $category->update(['status'=>1]);
         }
        return redirect()->back()->with('message','Category Status changed');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    



    public function edit(Catogory $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //   public function update(Request $request, Catogory $category)
    //   {
    //       $update = $category->update([

    //          'name' =>  $request->name,
    //          'description' => $request->description,
    //        'image' =>  $request->file('image')->store('category')
    //      ]);
    //      if($update)
     
    //      return redirect('/categories')->with('message','Category updated');

        
        
    //  }
    public function update(Request $request, Catogory $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'category/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $category->update($input);
    
        return redirect('/categories')->with('message','Category updated');
    }

    //  public function update(Request $request, Catogory $category)
    //  {
    //      $request->validate([
    //          'name' => 'required',
    //          'description' => 'required',
    //          'image' => 'required',

    //      ]);
    
    //      $input = $request->all();
  
    //      if ($image = $request->file('image')) {
    //         $destinationPath = 'category/';
    //         $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    //        $image->move($destinationPath, $profileImage);
    //         $input['image'] = "$profileImage";
    //      }else{
    //         unset($input['image']);
    //      }
          
    //      $category->update($input);

    //      return redirect('/categories')->with('message','Category updated');
    //  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catogory $category)
    {
       $delete = $category->delete();

       if($delete)
     
       return redirect()->back()->with('message','Category deleted');
    }
}
