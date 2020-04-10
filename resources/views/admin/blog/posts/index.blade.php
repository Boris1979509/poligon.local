@extends('layouts.app')

@section('content')
<table class="table table-bordered">
    @foreach ($item as $i)
    <tr>
        <td>{{ $i->id }}</td>
        <td>{{ $i->title }}</td>
        <td>{{ $i->content_raw }}</td>
    </tr>
    @endforeach
</table>
@endsection
