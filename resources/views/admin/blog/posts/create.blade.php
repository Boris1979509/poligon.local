@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.blog.posts.store') }}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.blog.posts.includes.item_create_main_col')
            </div>
            <div class="col-md-4">
                @include('admin.blog.posts.includes.item_edit_add_col')
            </div>
        </div>
    </form>
@endsection('content')
