@extends('admin.admin_master')

@section('admin_content')

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width: 10%;">ID</th>
								  <th style="width: 40%;">Size</th>
								  
								  <th style="width: 20%;">Status</th>
								  <th  style="width: 30%;">Actions</th>
							  </tr>
						  </thead> 

						  @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icon-off"></i>
            </button>


            <h4 class="alert-heading">Success!{{ session('message') }}</h4>    
    
            </div>
                @endif
                          @foreach($sizes as $size)
						  
						  <tbody>

							<tr>
								<td>{{$size->id}}</td>
								<td >
                                @foreach(json_decode($size->size) as $sizes)

                                <ul class="span3">
                                    {{$sizes}}
                                </ul>

                                @endforeach
                                </td>
								
                                
								<td class="center">
								@if($size->status==1) 
									<span class="label label-success">Active</span>

								@else
								<span class="label label-danger">Deactive</span>	
								@endif
								</td>
								<td class="=row">
									<div class="span3"></div>
									<div class="span2">
									@if($size->status==1) 
									<a href="{{url('/size-status'.$size->id)}}" class="btn btn-success" >
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a href="{{url('/size-status'.$size->id)}}" class="btn btn-danger" >
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif

									</div>
									<div class="span2">
									<a class="btn btn-info" href="{{url('/sizes/'.$size->id.'/edit')}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									</div>
									<div class="span2">
									<form method="post" action="{{url('/sizes/'.$size->id)}}">
										@csrf 
										@method('DELETE')
									<button class="btn btn-danger" type="submit">
									<i class="halflings-icon white trash"></i> 
									</button>	
									</form>
									</div>
									<div class="span3"></div>
								</td>
							</tr>
							
						
						
							
							
						
							
						
						  </tbody>

                        @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div>

@endsection 