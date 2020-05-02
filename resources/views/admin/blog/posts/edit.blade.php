@extends('layouts.app')
@section('content')
    @php /** @var App\Models\Blog\BlogPost $item */@endphp
    <form action="{{ route('admin.blog.posts.update', $item->id) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.blog.posts.includes.item_edit_main_col')
            </div>
            <div class="col-md-4">
                @include('admin.blog.posts.includes.item_edit_add_col')
            </div>
        </div>
    </form>
    {{-- DELETE --}}
    <form action="{{ route('admin.blog.posts.destroy', $item->id) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-link">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection('content')
