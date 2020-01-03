@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav class="navbar navbar-toggler bg-light">
                <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-primary">Add</a>
            </nav>
            <div class="cart">
                <div class="cart-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Parent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginator as $item)
                            @php /** App\Models\BlogCategory $item **/ @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href='{{ route('blog.admin.categories.edit', $item->id) }}' >{{ $item->title }}</a>
                                </td>
                                <td @if(in_array($item->parent_id, [0, 1])) class="text-black-50" @endif>{{ $item->parent_id }}</td>
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
</div>
@endsection('content')