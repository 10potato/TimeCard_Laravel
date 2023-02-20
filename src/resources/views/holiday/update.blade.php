@extends('layouts.layout')

@section('content')

<holiday-form-app
    :title="'{{$title}}'"
    :holiday-data="{{$holidayData}}"
    :update-flag="{{$updateFlag}}">
</holiday-form-app>

@endsection