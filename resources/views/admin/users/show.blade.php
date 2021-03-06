@extends('layouts.app')

@section('content')
    @include('admin.users._nav')
    @php
        /**
        * @var App\Models\User $user
        */
    @endphp
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>

        @if ($user->isWait())
            <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">{{ __('Status verify') }}</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>{{ __('ID') }}</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>{{ __('Name') }}</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>{{ __('Status') }}</th>
            <td>
                @if ($user->isWait())
                    <span class="badge badge-secondary">Waiting</span>
                @endif
                @if ($user->isActive())
                    <span class="badge badge-success">Active</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>{{ __('Role') }}</th>
            <td>
                @if ($user->isAdmin())
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
