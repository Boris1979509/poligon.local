@extends('layouts.app')
@section('content')
<form action="{{ route('blog.admin.categories.update', $item->id) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="container">
        @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            </div>
        </div>
        @endif
        @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.categories.includes.item_edit_main_col')
            </div>
            <div class="col-md-4">
                @include('blog.admin.categories.includes.item_edit_add_col')
            </div>
        </div>
    </div>
</form>
@endsection('content')