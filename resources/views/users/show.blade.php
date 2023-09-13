<?php
use Request as Input;
?>
@extends('layouts.master')
@section('title','Users Details')
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
                        <h2 class="content-header-title float-left mb-0">Users Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active">Users Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
        <div class="content-body">    
            <section class="app-user-view">
                @include('errormessage')
                <!-- User Card & Plan Starts -->
                <div class="row">
                    <!-- User Card starts-->
                    <div class="col-xl-12 col-lg-8 col-md-7">
                        <div class="card user-card">
                            <div class="card-body">
                                <div class="row">                                                        
                                    <div class="col-xl-4 col-lg-12 mt-2 mt-xl-0">
                                        <div class="user-info-wrapper">
                                            <div class="d-flex flex-wrap">
                                                <div class="user-info-title">
                                                    <i data-feather="user" class="mr-1"></i>
                                                    <span class="card-text user-info-title font-weight-bold mb-0">Name : </span>
                                                </div>
                                                <p class="card-text mb-0 ml-1">{{ isset($userData->name) ? $userData->name : '' }}</p>
                                            </div>
                                            
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="star" class="mr-1"></i>
                                                    <span class="card-text user-info-title font-weight-bold mb-0">Total Score : </span>
                                                </div>
                                                <p class="card-text mb-0 ml-1">{{ isset($userData->total_score) ? $userData->total_score : '' }}/{{ isset($userData->total_question) ? $userData->total_question : '' }}</p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="clock" class="mr-1"></i>
                                                    <span class="card-text user-info-title font-weight-bold mb-0">Total Time : </span>
                                                </div>
                                                <p class="card-text mb-0 ml-1">{{ isset($userData->total_time) ? $userData->total_time : '' }}</p>
                                            </div>
                                        </div>
                                    </div>                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card Ends-->                                                                            
        
                </div>
                <!-- User Card & Plan Ends -->                                    
            </section>   

            <!-- Basic table -->
            <section id="ajax-datatable">                
                <div class="row">
                    <div class="col-12">
                        @include('errormessage')
                        <div class="card">
                            <div class="card-datatable">
                                <table class="datatables-ajax table" id="user-table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Option A</th>
                                            <th>Option B</th>
                                            <th>Option C</th>
                                            <th>Option D</th>
                                            <th>User Answer</th>                                                                     
                                            <th>Correct / Incorrect</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('script')
<script>
$(document).ready(function () {
    var initTable1 = function () {
        var table = $('#user-table');
            // begin first table
            table.DataTable({
            lengthMenu: getPageLengthDatatable(),
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                    url: "{{route('getuserresult')}}",
                            type: 'post',
                            data: function (data) {
                            data.fromValues = $("#filterData").serialize();
                            data.user_id = <?php echo $userData->id; ?>;
                            }
                    },
                    columns: [
                        {data: 'question.question', name: 'question.question', defaultContent: ''},
                        {data: 'question.option_a', name: 'question.option_a', defaultContent: ''},
                        {data: 'question.option_b', name: 'question.option_b', defaultContent: ''},
                        {data: 'question.option_c', name: 'question.option_c', defaultContent: ''},
                        {data: 'question.option_d', name: 'question.option_d', defaultContent: ''},                    
                        {data: 'answer', name: 'answer', defaultContent: ''},
                        {data: 'is_correct', name: 'is_correct', defaultContent: ''}        
                    ],
            });
    };
    initTable1();
});
</script>
@endsection
