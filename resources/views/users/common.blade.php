<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Name</label>
            {!! Form::text('name',Input::old('name'), ['class' => 'form-control','id'=>"name",'placeholder'=>'Enter Name']) !!} 
        </div>                                   
    </div>        
    <div class="col-md-6">
        <div class="form-group">
            <label for="account-new-password">Password</label>
            <div class="input-group form-password-toggle input-group-merge">
                <input type="password" name="password" class="form-control" id="password"  placeholder="Enter Password" maxlength="100" autocomplete="new-password"/>
                <div class="input-group-append">
                    <div class="input-group-text cursor-pointer">
                        <i data-feather="eye"></i>
                    </div>
                </div>
            </div>
        </div>       
    </div>                                                                              
</div>

<div class="row">    
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-password">Confirm Password</label>
            <div class="input-group form-password-toggle input-group-merge">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password" maxlength="100">
                <div class="input-group-append">
                    <div class="input-group-text cursor-pointer">
                        <i data-feather="eye"></i>
                    </div>
                </div>
            </div>
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
        <a href="{{ route('users.index') }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
    </div>
</div>            
