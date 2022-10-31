@extends('admin.admin_master')

@section('admin_content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>

           
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Brand</h2>

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
                <form class="form-horizontal" action="{{url('/brands/'.$brand->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Brand Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="name" value="{{$brand->name}}">
                            </div>
                        </div>


                        <div class="control-group ">
                            <label class="control-label" for="textarea2">Brand Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="description" rows="3" required>{{$brand->description}}</textarea>
                            </div>

                        </div>

                        


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Brand</button>
                        </div>
                    </fieldset>
                </form>
                   
               

            </div>
        </div><!--/span-->
    </div><!--/row-->
    </div><!--/row-->
@endsection