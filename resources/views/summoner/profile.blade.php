@extends('layouts.default')

@section('content')
    <profile :summoner="{{ json_encode($summoner) }}" :matches="{{ json_encode($matches) }}"></profile>
@endsection