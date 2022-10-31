@extends('admin.admin_master')

@section('admin_content')




    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>

           
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Color</h2>

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
                <form class="form-horizontal" action="{{url('/colors')}}" method="post" >
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01" >Color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="color"   data-role="tagsinput" required>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Color</button>
                        </div>
                    </fieldset>
                </form>
                   
               

            </div>
        </div><!--/span-->
    </div><!--/row-->
    </div><!--/row-->
@endsection