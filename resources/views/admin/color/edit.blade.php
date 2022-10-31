@extends('admin.admin_master')

@section('admin_content')



    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>

           
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Color</h2>

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
                <form class="form-horizontal" action="{{url('/colors/'.$color->id)}}" method="post" >
                @csrf
                @method('PUT')

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="color" data-role="tagsinput" value="{{implode(',',Json_decode($color->color))}}">
                            </div>
                        </div>


                        

                        


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Color</button>
                        </div>
                    </fieldset>
                </form>
                   
               

            </div>
        </div><!--/span-->
    </div><!--/row-->
    </div><!--/row-->
@endsection