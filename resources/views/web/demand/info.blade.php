@extends('layouts.default')

@section('title')
    {{@$title}}
@stop
@section('top')

@stop
@section('content')
<div class="container" style="margin:0 auto;padding: 48px 0 0 0;width: 100%;">
    <h2>{{ $demand->title }}</h2>
</div>
@stop
@section('bottom')

@stop