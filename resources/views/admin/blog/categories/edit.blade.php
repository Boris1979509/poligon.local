@extends('layouts.app')
@section('content')
    @php /** @var App\Models\Blog\BlogCategory $item */@endphp
    <form action="{{ route('admin.blog.categories.update', $item->id) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.blog.categories.includes.item_edit_main_col')
            </div>
            <div class="col-md-4">
                @include('admin.blog.categories.includes.item_edit_add_col')
            </div>
        </div>
    </form>
@endsection('content')
