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
								  <th style="width: 5%;">code</th>
								  <th style="width: 5%;">Product Name</th>
								  <th style="width: 15%;">Description</th>
                                  <th  style="width: 5%;">Price</th>
                                  <th  style="width: 5%;">Category Name</th>
                                  <th  style="width: 5%;">Sub Category Name</th>
                                  <th  style="width: 5%;">Brand</th>
								  <th style="width: 23%;">Image</th>
                                  <th style="width: 10%;">Status</th>
								  <th  style="width: 22%;">Actions</th>
                                  
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
                          @foreach($products as $product)
						  @php
                          $product['image']=explode("|",$product->image);
                          @endphp
						  <tbody>

							<tr>
								<td>{{$product->code}}</td>
								<td class="center">{{$product->name}}</td>
								<td class="center">{!!$product->description!!}</td>
                                <td class="center">&#2547;{{$product->price}}</td>
                                
                                <td class="center">{{$product->category->name}}</td>
                                <td class="center">{{$product->subcategory->name}}</td>
                                <td class="center">{{$product->brand->name}}</td>
                                <td class=>
                                @foreach($product->image as $images)
                                    <img src="{{asset('/image/'.$images)}}" style="width: 50px;height:auto ;">
                                    @endforeach
                                </td>
								<td class="center">
								@if($product->status==1) 
									<span class="label label-success">Active</span>

								@else
								<span class="label label-danger">Deactive</span>	
								@endif
								</td>
								<td class="=row">
									<div class="span3"></div>
									<div class="span2">
									@if($product->status==1) 
									<a href="{{url('/product-status'.$product->id)}}" class="btn btn-success" >
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a href="{{url('/product-status'.$product->id)}}" class="btn btn-danger" >
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif

									</div>
									<div class="span2">
									<a class="btn btn-info" href="{{url('/products/'.$product->id.'/edit')}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									</div>
									<div class="span2">
									<form method="post" action="{{url('/products/'.$product->id)}}">
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