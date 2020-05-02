@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="{{ route('admin.blog.posts.create') }}"
               class="btn btn-primary mb-3">{{ __('Add post') }}</a>
            <div class="cart">
                <div class="cart-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Date published') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php /** @var BlogPost $post */use App\Models\Blog\BlogPost; @endphp
                        @foreach ($paginator as $post)
                            <tr @if(!$post->is_published) class="table-active" @endif>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td><a href="{{ route('admin.blog.posts.edit', $post) }}">{{ $post->title }}</a></td>
                                <td>{{ ($post->published_at) ? \Carbon\Carbon::parse($post->published_at)->format('d.M H.i') : null }}</td>
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
@endsection
