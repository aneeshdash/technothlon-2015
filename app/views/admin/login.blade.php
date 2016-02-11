@extends('layouts.master')
@section('title')
    CRep Login | Technothlon
    @endsection
@section('head')
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('font-awesome-4.3.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/creplogin.css') }}">
    <link href="{{ asset('admin_crep/plugins/iCheck/flat/green.css') }}" rel="stylesheet" type="text/css" />
    @endsection
@section('body')
    <div class="ribbon"></div>
    <div class="login">
        <h1>Let's get started.</h1>
        <p>This will be an amazing experience</p>
        @if(Session::has('error'))<p style="color: red">{{ Session::get('error') }}</p>@endif
        @if($errors->has())
            <p style="color: red">Captha Validation Failed</p>
        @endif
        <form method="post" action="{{ route('creplogin') }}">
            <div class="input">
                <div class="blockinput">
                    <i class="fa fa-envelope"></i><input style="border: none; box-shadow: none" type="mail" placeholder="Email" name="email">
                </div>
                <div class="blockinput">
                    <i class="fa fa-lock"></i><input style="border: none; box-shadow: none" type="password" placeholder="Password" name="password">
                </div>
            </div>
            <a href="{{ route('crepforgot') }}" style="font-size: medium">Forgot Password?</a>
            <div class="form-group">
                <label style="font-size: 14px">
                    <input type="checkbox" name="remember" checked/>
                    Remember Me
                </label>
                </div>
{{--            {{ Form::captcha() }}--}}
            <input type="submit" value="Login">
        </form>
    </div>
    <script src="{{ asset('admin_crep/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
    @endsection
