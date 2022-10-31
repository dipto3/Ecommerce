@extends('admin.admin_master')

@section('admin_content')




    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>

           
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Category</h2>

            </div>


          


            <div class="box-content">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icon-off"></i>
            </button>


            <h4 class="alert-heading">Success!{{ session('message') }}</h4>    
    
            </div>
                @endif
                <form class="form-horizontal" action="{{url('/sub-categories/'.$subCategory->id)}}" method="post" >
                @csrf
                @method('PUT')

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Sub Category Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="name" value="{{$subCategory->name}}">
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Select Category</label>
                            <div class="control">
                                <select name="category" style="margin-left: 20px">
                                <option>Select Category</option>

                                @foreach($categories as $category)

                                <option value="{{$category->id}}">{{$category->name}}</option>

                                @endforeach
                                


                                </select>
                            </div>
                         </div>


                        <div class="control-group ">
                            <label class="control-label" for="textarea2">Sub Category Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="description" rows="3" required>{{$subCategory->description}}</textarea>
                            </div>

                        </div>

                       

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update sub Category</button>
                        </div>
                    </fieldset>
                </form>
                   
               

            </div>
        </div><!--/span-->
    </div><!--/row-->
    </div><!--/row-->
@endsection