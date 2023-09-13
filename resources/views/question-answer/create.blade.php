@extends('layouts.master')
@section('title','Create Question')
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
                        <h2 class="content-header-title float-left mb-0">Create Question</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('question-answer.index') }}">Question & Answer</a>
                                </li>
                                <li class="breadcrumb-item active">Create Question
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
                                {!! Form::open(['route' => 'question-answer.store','name'=>'createform', 'id'=>"createform",'enctype'=>'multipart/form-data']) !!} 
                                @include('question-answer.common')
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
        $("#answer").select2({
            placeholder: "Select Answer",
            allowClear: true
        });
    });

    $("#createform").validate({
        rules: {
            question: {
                required: true
            },
            option_a: {
                required: true
            },
            option_b: {
                required: true
            },
            option_c: {
                required: true
            },
            option_d: {
                required: true
            },
            answer: {
                required: true
            }        
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
                url: "{{route('question-answer.store')}}",
                type: "POST",
                data: $('#createform').serialize(),
                success: function(response) {                    
                    if(response.status){
                        toastr.success(response.msg);
                        document.getElementById("createform").reset(); 
                        $("#answer").val(null).trigger("change");      
                    }else{
                        toastr.error(response.msg);
                    }
                    $(".submitbutton"). attr("disabled", false);
                    $('.indicator-progress').addClass("d-none");
                }
            });
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "answer") {
                error.appendTo(element.parent("div"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).attr("id") == "answer") {
                $($(element).parent("div")).addClass("has-error");
            } else {
                $(element).addClass("has-error");
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if ($(element).attr("id") == "answer") {
                $($(element).parent("div")).removeClass("has-error");
            } else {
                $(element).removeClass("has-error");
            }
        }
    });
</script>
@endsection
