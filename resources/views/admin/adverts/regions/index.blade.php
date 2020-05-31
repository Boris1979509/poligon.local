@extends('layouts.app')

@section('content')
    {{--@include('admin.adverts.regions._nav')--}}
    <p><a href="{{ route('admin.adverts.regions.create') }}" class="btn btn-success">{{ __('Add region') }}</a></p>
    @include('admin.adverts.regions._list', compact('regions'))
@endsection
