@extends('technopedia.layout')
@section('body')
    {{ $body }}
    {{ Session::get('score') }}<br>
    {{ Session::get('question') }}
    @endsection