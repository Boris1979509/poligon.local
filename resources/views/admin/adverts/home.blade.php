@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.adverts.home') }}">{{ __('Home') }}</a>
        </li>
    </ul>
@endsection

