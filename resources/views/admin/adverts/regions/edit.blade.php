@extends('layouts.app')

@section('content')
    {{--    @include('admin.regions._nav')--}}

    <form method="POST" action="{{ route('admin.adverts.regions.update', $region) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                   value="{{ old('name', $region->name) }}">
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="slug" class="col-form-label">{{ __('Slug') }}</label>
            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
                   value="{{ old('slug', $region->slug) }}">
            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
