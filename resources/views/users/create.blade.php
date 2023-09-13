@extends('layouts.master')
@section('title','Create User')
@section('css')
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Create User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active">Create User
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                @include('errormessage')
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Account Tab starts -->
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                <!-- users edit account form start -->
                                {!! Form::open(['route' => 'users.store','name'=>'createform', 'id'=>"createform",'enctype'=>'multipart/form-data']) !!} 
                                @include('users.common')
                                {!! Form::close() !!}
                                <!-- users edit account form ends -->
                            </div>
                            <!-- Account Tab ends -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {       
        $("#role_type").select2({
            placeholder: "Select Role",
            allowClear: true
        });
    });

    $.validator.addMethod("password", function (value, element) {
        let password = value;
        if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#?!@$%^&*-])/.test(password))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let password = $(element).val();
        if (!(/^(?=.*[A-Z])/.test(password))) {
            return "Password must contains at least one Uppercase.";
        } else if (!(/^(?=.*[a-z])/.test(password))) {
            return "Password must contains at least one Lowercase.";
        } else if (!(/^(?=.*[0-9])/.test(password))) {
            return "Password must contans at least one Digit.";
        } else if (!(/^(?=.*[#?!@$%^&*-])/.test(password))) {
            return "Password must contans at least one Special Character";
        }
        return false;
    });

    $("#createform").validate({
        rules: {
            name: {
                required: true,
                maxlength: 100
            },
            password: {
                required: true,
                password: true,
                minlength: 8,
                maxlength: 20
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },          
        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(".submitbutton"). attr("disabled", true);
            $('.indicator-progress').removeClass("d-none");

            $.ajax({
                url: "{{route('users.store')}}",
                type: "POST",
                data: $('#createform').serialize(),
                success: function(response) {                    
                    if(response.status){
                        toastr.success(response.msg);
                        document.getElementById("createform").reset();       
                    }else{
                        toastr.error(response.msg);
                    }
                    $(".submitbutton"). attr("disabled", false);
                    $('.indicator-progress').addClass("d-none");
                }
            });
        }
    });
</script>
@endsection
