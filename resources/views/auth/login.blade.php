@extends('layouts.login')

@section('content')
<div class="login-widget animation-delay1"> 
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-left">
                <i class="fa fa-lock fa-lg"></i> Login
            </div>
        </div>
        <div class="panel-body">
            {!! Form::open([
                'url' => 'auth/login',
                'class' => 'form form-login',
            ]) !!}
                <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                    <label>Email</label>
                    {!! Form::text('email', null, [
                        'class' => 'form-control input-sm animation-delay2',
                        'placeholder' => 'Email',
                    ]) !!}
                    @if($errors->has('email'))
                        <span id="helpBlock2" class="help-block text-error">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                    <label>Password</label>
                    {!! Form::password('password', [
                        'class' => 'form-control input-sm bounceIn animation-delay4',
                        'placeholder' => 'Password',
                    ]) !!}
                    @if($errors->has('password'))
                        <span id="helpBlock2" class="help-block text-error">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                
                <div class="form-group animation-delay6 " >
                            <label for="type1">Stock</label>
                            <select class="form-control chzn-select bounceIn animation-delay6 ">
                                
                                <option>MIXED</option>
                                <option>TRUE BFKT</option>
                                <option>TRUE RSO</option>
                                                                                                        
                            </select>
                           
                </div>
                <div class="form-group">
                    <label class="label-checkbox inline">
                        {!! Form::checkbox('remember', null, [
                            'class' => 'regular-checkbox chk-delete',
                        ]) !!}
                        <span class="custom-checkbox info bounceIn animation-delay6"></span>
                    </label>
                    Remember me     
                </div>

                <div class="seperator"></div>
                <div class="form-group">
                    Forgot your password?<br/>
                    Click <a href="#">here</a> to reset your password
                </div>

                <hr/>

                <button 
                    name="sign_in"
                    class="btn btn-success btn-sm bounceIn animation-delay7 login-link pull-right"
                    type="submit">
                    <i class="fa fa-sign-in"></i> Sign In
                </button>
            {!! Form::close() !!}
        </div>
    </div><!-- /panel -->
</div><!-- /login-widget -->
@endsection