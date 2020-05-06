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
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Parent') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            /**
                            * @var BlogCategory $item
                            */use App\Models\Blog\BlogCategory;
                        @endphp
                        @foreach ($paginator as $item)

                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href='{{ route('admin.blog.categories.edit', $item->id) }}'>{{ $item->title }}</a>
                                </td>
                                <td class="text-black-50">{{ $item->parentTitle }}
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
