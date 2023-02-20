@extends('layouts.layout')

@section('content')

<sample-index-app
    :title="'{{$title}}'"
    :sample-message="'{{$sampleMessage}}'"
    :sample-data="{{json_encode($sampleData)}}">
</sample-index-app>

@endsection