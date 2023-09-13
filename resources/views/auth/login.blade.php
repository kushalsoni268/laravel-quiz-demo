@extends('layouts.loginmaster')
@section('title','Admin Login')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Login v1 -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="brand-logo">                           
                                <h2 class="brand-text text-primary ml-1">Admin Sign In</h2>                                                                     
                            </a>
                            <h4 class="card-title mb-1">Welcome to Admin! 👋</h4>
                            <p class="card-text mb-2">Please sign-in to your account</p>

                                {!! Form::open(['route' => 'admin.post.login','class'=>'login-form mt-2','name'=>'createform', 'id'=>"login-form",'enctype'=>'multipart/form-data','method'=>'POST']) !!} 
                                @csrf
                                @include('errormessage')
                                <div class="form-group">
                                    <label for="login-email" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Username" aria-describedby="login-email" tabindex="1" autofocus />
                                </div>

                                <div class="form-group">                                    
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="Enter Password" aria-describedby="login-password" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block submitbutton waves-effect" tabindex="4">
                                    <span class="align-middle">Sign in</span>                                    
                                </button>
                                {!! Form::close() !!}                                             
                        </div>
                    </div>
                    <!-- /Login v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#login-form").validate({
            rules: {
                name: {
                    required: true                    
                },
                password: {
                    required: true
                },
            },
            submitHandler: function (form) {
                if ($("#login-form").validate().checkForm()) {
                    $('.loader-btn').removeClass("display-none");
                    $(".submitbutton").attr("type", "button");
                    $('.submitbutton').prop('disabled', true);
                    form.submit();
                }
            }
        });

    });
</script>
@endsection
