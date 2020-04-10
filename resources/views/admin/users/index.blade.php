@extends('layouts.app')

@section('content')
    @include('admin.users._nav')

    <p><a href="{{ route('admin.users.create') }}" class="btn btn-success">{{ __('Add User') }}</a></p>

    <div class="card mb-3">
        <div class="card-header">{{ __('Filter') }}</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="id" class="col-form-label">{{ __('ID') }}</label>
                        <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">{{ __('Name') }}</label>
                        <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">{{ __('Status') }}</label>
                        <select id="status" class="form-control" name="status">
                            <option value=""></option>
                            @php /** @var App\Http\Controllers\Admin\Users\UsersController $statuses */ @endphp
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" {{ ($value === request('status')) ? ' selected' : ''
                                    }}>{{ $label }}
                                </option>
                            @endforeach;
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-form-label">{{ __('Role') }}</label>
                        <select id="role" class="form-control" name="role">
                            <option value=""></option>
                            @php /** @var App\Http\Controllers\Admin\Users\UsersController $roles */ @endphp
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}" {{ ($value === request('role')) ? ' selected' : ''
                                    }}>{{ $label }}
                                </option>
                            @endforeach;
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Search') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Role') }}</th>
        </tr>
        </thead>
        <tbody>
        @php /** @var App\Http\Controllers\Admin\Users\UsersController $users */ @endphp
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                    @if ($user->isActive())
                        <span class="badge badge-success">Active</span>
                    @endif
                </td>
                <td>
                    @if ($user->isAdmin())
                        <span class="badge badge-danger">Admin</span>
                    @else
                        <span class="badge badge-secondary">User</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->links() }}
@endsection
