@extends('frontend.master')
@section('content')

<style>
    .login-container{
        
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-logo{
    position: relative;
    margin-left: -41.5%;
}
.login-logo img{
    position: absolute;
    width: 20%;
    margin-top: 19%;
    background: #282726;
    border-radius: 4.5rem;
    padding: 5%;
}
.login-form-1{
    
    padding: 14%;
    background:#3c68e2;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    
    text-align: center;
    margin-bottom:12%;
    color:#fff;
}
.login-form-2{
    padding: 9.1%;
    background: #1e1f29;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    margin-bottom:12%;
    color: #fff;
}
.btnSubmit{
    font-weight: 600;
    width: 50%;
    color: #282726;
    background-color: #fff;
    border: none;
    border-radius: 1.5rem;
    padding:2%;
}
.btnForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.btnForgetPwd:hover{
    text-decoration:none;
    color:#fff;
}
</style> @if(session('message'))
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icon-off"></i>
            </button>


            <h4 class="alert-heading">{{ session('message') }}</h4>    
    
            </div>
                @endif

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>User Login  </h3>
                    
                    <form action="{{url('/customer-login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="btnForgetPwd">Forget Password?</a>
                        </div>
                        </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <div class="login-logo">
                        <img src="./img/click.png       " alt=""/>
                    </div>
                    <h3>Registration Form </h3>
                    <form action="{{url('/customer-registration')}}" method="post">
                        @csrf
                         <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Full Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"name="email" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile" class="form-control" placeholder="Your Mobile Number *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">

                            <a href="#" class="btnForgetPwd" value="Login">Forget Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


@endsection