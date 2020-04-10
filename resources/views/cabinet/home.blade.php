@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cabinet') }}</div>
                    <div class="card-body">
                        Welcome, {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection