<?php
use Request as Input;
?>
@extends('layouts.master')
@section('title','Test')
@section('css')
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    {!! Form::open(['route' => 'post.test','name'=>'submit-test-form', 'id'=>"submit-test-form"]) !!}
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Test</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Test
                                </li>                                                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>     
            
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <Span class="btn btn-primary" style="width: 120px;">
                            <span id="h">00</span>:
                            <span id="m">00</span>:
                            <span id="s">00</span>
                            {{ Form::hidden('hours', '00', array('id' => 'hours')) }}
                            {{ Form::hidden('minutes', '00', array('id' => 'minutes')) }}
                            {{ Form::hidden('seconds', '00', array('id' => 'seconds')) }}
                        </Span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">                                              
            <!-- Modern Vertical Wizard -->
            <section class="modern-vertical-wizard">
                @include('errormessage')                 
                <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
                    <div class="bs-stepper-header">
                        @foreach($questions as $key => $value)
                        <div class="step" data-target="#question-{{  $key + 1 }}-modern">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    {{ $key + 1 }}</i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Question {{ $key + 1 }}</span>
                                    <span class="bs-stepper-subtitle">&nbsp;</span>
                                </span>
                            </button>
                        </div>                        
                        @endforeach
                    </div>
                    <div class="bs-stepper-content">
                        @foreach($questions as $key => $value)
                        <div id="question-{{  $key + 1 }}-modern" class="content">
                            <div class="content-header">
                                <h5 class="mb-0">{{ $key + 1 }}) &nbsp; {{ $value->question }}</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="question_{{ $value->id }}" id="question_{{ $key + 1 }}_a" value="A">
                                        <label class="form-check-label" for="inlineRadio1">A) &nbsp; {{ $value->option_a }}</label>
                                    </div>                                    
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="question_{{ $value->id }}" id="question_{{ $key + 1 }}_b" value="B">
                                        <label class="form-check-label" for="inlineRadio1">B) &nbsp; {{ $value->option_b }}</label>
                                    </div>                                    
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="question_{{ $value->id }}" id="question_{{ $key + 1 }}_c" value="C">
                                        <label class="form-check-label" for="inlineRadio1">C) &nbsp; {{ $value->option_c }}</label>
                                    </div>                                    
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="question_{{ $value->id }}" id="question_{{ $key + 1 }}_d" value="D">
                                        <label class="form-check-label" for="inlineRadio1">D) &nbsp; {{ $value->option_d }}</label>
                                    </div>                                    
                                </div>                                
                            </div>                            
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev" {{ $key == 0 ? 'disabled' : '' }}>
                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                @if($key == count($questions) - 1)
                                <button class="btn btn-success btn-submit">Submit</button>
                                @else
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </button>
                                @endif
                            </div>
                        </div>                       
                        @endforeach
                    </div>
                </div>                
            </section>            
            <!-- /Modern Vertical Wizard -->

        </div>
    </div>
    {!! Form::close() !!}
</div>
<!-- END: Content-->
@endsection
@section('script')
<script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
<script>
$(document).ready(function () {    
    var initTable1 = function () {
        var table = $('#question-answer-table');
            // begin first table
            table.DataTable({
            lengthMenu: getPageLengthDatatable(),
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                    url: "{{route('getquestionanswer')}}",
                            type: 'post',
                            data: function (data) {
                            data.fromValues = $("#filterData").serialize();
                            }
                    },
                    columns: [
                        {data: 'question', name: 'question', defaultContent: ''},
                        {data: 'option_a', name: 'option_a', defaultContent: ''},
                        {data: 'option_b', name: 'option_b', defaultContent: ''},
                        {data: 'option_c', name: 'option_c', defaultContent: ''},
                        {data: 'option_d', name: 'option_d', defaultContent: ''},
                        {data: 'answer', name: 'answer', defaultContent: ''},                    
                        {data: 'action', name: 'action', searchable: false, sortable: false, responsivePriority: - 1}                   
                    ],
            });
    };
    initTable1();
});
</script>
<script>
$(document).ready(function() {
    (function($){
        $.extend({            
            APP : {                               
                formatTimer : function(a) {
                    if (a < 10) {
                        a = '0' + a;
                    }                              
                    return a;
                },    
                
                startTimer : function() {                
                    // get current date
                    $.APP.d1 = new Date();
                    
                    switch($.APP.state) {
                            
                        case 'pause' :
                            
                            // get current timestamp (for calculations) and
                            // substract time difference between pause and now
                            $.APP.t1 = $.APP.d1.getTime() - $.APP.td;                            
                            
                        break;
                            
                        default :
                            
                            // get current timestamp (for calculations)
                            $.APP.t1 = $.APP.d1.getTime();                            
                        
                        break;
                            
                    }          
                    
                    // reset state
                    $.APP.state = 'alive';                    
                    
                    // start loop
                    $.APP.loopTimer();
                    
                },                                            
                
                loopTimer : function() {
                    
                    var td;
                    var d2,t2;
                    
                    var ms = 0;
                    var s  = 0;
                    var m  = 0;
                    var h  = 0;
                    
                    if ($.APP.state === 'alive') {
                    
                        // get current date and convert it into 
                        // timestamp for calculations
                        d2 = new Date();
                        t2 = d2.getTime();   
                        
                        // calculate time difference between
                        // initial and current timestamp                    
                        td = t2 - $.APP.t1;
                        
                        // calculate milliseconds
                        ms = td%1000;
                        if (ms < 1) {
                            ms = 0;
                        } else {    
                            // calculate seconds
                            s = (td-ms)/1000;
                            if (s < 1) {
                                s = 0;
                            } else {
                                // calculate minutes   
                                var m = (s-(s%60))/60;
                                if (m < 1) {
                                    m = 0;
                                } else {
                                    // calculate hours
                                    var h = (m-(m%60))/60;
                                    if (h < 1) {
                                        h = 0;
                                    }                             
                                }    
                            }
                        }
                    
                        // substract elapsed minutes & hours
                        ms = Math.round(ms/100);
                        s  = s-(m*60);
                        m  = m-(h*60);                        

                        // update display
                        $('#ms').html($.APP.formatTimer(ms));
                        $('#s').html($.APP.formatTimer(s));
                        $('#m').html($.APP.formatTimer(m));
                        $('#h').html($.APP.formatTimer(h));

                        $('#seconds').val($.APP.formatTimer(s));
                        $('#minutes').val($.APP.formatTimer(m));
                        $('#hours').val($.APP.formatTimer(h));                                    
                        
                        // loop
                        $.APP.t = setTimeout($.APP.loopTimer,1);
                    
                    } else {
                    
                        // kill loop
                        clearTimeout($.APP.t);
                        return true;
                    
                    }  
                    
                }
                    
            }    
        
        });                    
        $.APP.startTimer();                            
    })(jQuery);
});
</script>
@endsection
