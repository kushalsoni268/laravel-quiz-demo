<?php
use Request as Input;
?>
@extends('layouts.master')
@section('title','Users')
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
                        <h2 class="content-header-title float-left mb-0">Users</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Users
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <a href="{{ route('users.create')}} "> <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Add User</button></a>
                    </div>
                </div>
            </div>    

        </div>
        <div class="content-body">            
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
                                            <th>Username</th>                                        
                                            <th>Test Status</th>                                            
                                            <th>Action</th>
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
                    url: "{{route('getusers')}}",
                            type: 'post',
                            data: function (data) {
                            data.fromValues = $("#filterData").serialize();
                            }
                    },
                    columns: [
                        {data: 'name', name: 'name', defaultContent: ''},                    
                        {data: 'is_test_attended', name: 'is_test_attended'},
                        {data: 'action', name: 'action', searchable: false, sortable: false, responsivePriority: - 1}        
                    ],
            });
    };
    initTable1();
});
</script>
@endsection
