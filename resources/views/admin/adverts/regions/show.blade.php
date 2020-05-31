@extends('layouts.app')

@section('content')
    {{--    @include('admin.regions._nav')--}}

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.adverts.regions.edit', $region) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>
        <form method="POST" action="{{ route('admin.adverts.regions.update', $region) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">{{__('Delete') }}</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>{{ __('ID') }}</th>
            <td>{{ $region->id }}</td>
        </tr>
        <tr>
            <th>{{ __('Name') }}</th>
            <td>{{ $region->name }}</td>
        </tr>
        <tr>
            <th>{{ __('Slug') }}</th>
            <td>{{ $region->slug }}</td>
        </tr>
        </tbody>
    </table>

    <p><a href="{{ route('admin.adverts.regions.create', ['parent' => $region->id]) }}"
          class="btn btn-success">{{ __('Add SubRegion') }}</a></p>

    @include('admin.adverts.regions._list', compact('regions'))
@endsection
