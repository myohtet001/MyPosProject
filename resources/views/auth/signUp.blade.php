@extends('layouts.template')
@section('title')
    Sign Up
    @endsection
@section('content')
    @include('partials.nav_bar')
    @include('nav_footer')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                @if(Session('success'))<div class="alert alert-success">{{Session('success')}}</div> @endif
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Sign Up</div>
                    <div class="panel panel-body">
                        <form method="post" action="{{route('SignUp')}}">
                            <div class="form-group @if($errors->has('userName')) has-error @endif ">
                                @if($errors->has('userName')) <span class="help-block">{{$errors->first('userName')}}</span> @endif
                           <input type="text" class="form-control" name="userName" id="userName" placeholder="Name">
                            </div>
                            <div class="form-group @if($errors->has('email')) has-error @endif ">
                                @if($errors->has('email')) <span class="help-block">{{$errors->first('email')}}</span> @endif
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail Address">
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span> @endif
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group @if($errors->has('confirmPassword')) has-error @endif">
                                @if($errors->has('confirmPassword'))<span class="help-block">{{$errors->first('confirmPassword')}}</span> @endif
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                    <button type="submit" name="btn" class="btn btn-primary">Register</button>
                                </div>

                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection