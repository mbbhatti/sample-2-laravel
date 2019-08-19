@extends('layouts/layout')

@section('pageTitle', 'Welcome')

@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Welcome
        </div>

        <div class="links">
            <a href="{{ url('/email') }}">Send Email</a>
            <a href="{{ url('/logs') }}">Email Logs</a>
        </div>
    </div>
</div>

@stop