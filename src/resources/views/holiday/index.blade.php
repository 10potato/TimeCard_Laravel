@extends('layouts.layout')

@section('content')

<holiday-index-app
    :title="'{{$title}}'"
    :holiday-data="{{$holidayData}}">
</holiday-index-app>

@endsection