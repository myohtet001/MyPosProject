@extends('layouts.template')
@section('title')
    Login
@endsection
@section('content')
    @include('partials.nav_bar')
    @include('nav_footer')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                @if(Session('error'))<div class="alert alert-danger">{{Session('error')}}</div> @endif
                <div class="panel panel-primary">

                    <div class="panel panel-heading">Login</div>
                    <div class="panel panel-body">
                        <form method="post" action="{{route('login')}}">
                            <div class="form-group @if($errors->has('userName')) has-error @endif ">
                                @if($errors->has('userName')) <span class="help-block">{{$errors->first('userName')}}</span> @endif
                                <input type="text" class="form-control" name="userName" id="userName" placeholder="Name">
                            </div>

                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span> @endif
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btn" class="btn btn-primary">Login</button>
                            </div>

                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection