@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="{{ route('admin.blog.categories.create') }}"
               class="btn btn-primary mb-3">{{ __('Add category') }}</a>
            <div class="cart">
                <div class="cart-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>Category</th>
                            <th>{{ __('Parent') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($paginator as $key => $item)
                            @php
                                /**
                                * @var App\Models\Blog\BlogCategory $item
                                */
                            @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href='{{ route('admin.blog.categories.edit', $item->id) }}'>{{ $item->title }}</a>
                                </td>
                                <td @if(in_array($item->parent_id, [0, 1])) class="text-black-50" @endif>{{
                                    $item->parent_id }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($paginator->total() > $paginator->count())
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="cart">
                    <div class="cart-body">
                        {{ $paginator->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection('content')
