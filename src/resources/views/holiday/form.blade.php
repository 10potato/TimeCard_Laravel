@extends('layouts.layout')

@section('content')

<holiday-form-app
    :title="'{{$title}}'"
    :update-flag="{{$updateFlag}}">
</holiday-form-app>

@endsection