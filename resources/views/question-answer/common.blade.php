<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Question</label>
            {!! Form::text('question',Input::old('question'), ['class' => 'form-control','id'=>"question",'placeholder'=>'Enter Question']) !!} 
        </div>                                   
    </div>        
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Option A</label>
            {!! Form::text('option_a',Input::old('option_a'), ['class' => 'form-control','id'=>"option_a",'placeholder'=>'Enter Option A']) !!} 
        </div>                                   
    </div>                                                                              
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Option B</label>
            {!! Form::text('option_b',Input::old('option_b'), ['class' => 'form-control','id'=>"option_b",'placeholder'=>'Enter Option B']) !!} 
        </div>                                   
    </div>        
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Option C</label>
            {!! Form::text('option_c',Input::old('option_c'), ['class' => 'form-control','id'=>"option_c",'placeholder'=>'Enter Option C']) !!} 
        </div>                                   
    </div>                                                                          
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Option D</label>
            {!! Form::text('option_d',Input::old('option_d'), ['class' => 'form-control','id'=>"option_d",'placeholder'=>'Enter Option D']) !!} 
        </div>                                   
    </div>        
    <div class="col-md-6">
        <div class="form-group">
            <label for="answer">Answer</label>
            <select id="answer" class="form-control" name="answer">
                <option  value="">Select Answer</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
    </div>                                                                            
</div>

<div class="row">        
    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 submitbutton" name="submit" value="Submit">
            <span class="indicator-label d-flex align-items-center justify-content-center">Save 
                <span class="indicator-progress d-none"> &nbsp;&nbsp;&nbsp;
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </span>

        </button>&nbsp;
        <a href="{{ route('question-answer.index') }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
    </div>
</div>            
