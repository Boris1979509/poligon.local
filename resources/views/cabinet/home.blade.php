@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Welcome') . ', ' . Auth::user()->name }}</div>
                <div class="card-body">
                    @can('allow-access-admin')
                        <a href="{{ route('admin.blog.posts.index') }}"
                           class="btn btn-outline-primary">{{ __('Blog') }}</a>
                        <a href="{{--route('admin.blog.posts.index')--}}"
                           class="btn btn-outline-success">{{ __('Adverts') }}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
