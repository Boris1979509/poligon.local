<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Slug') }}</th>
    </tr>
    </thead>
    <tbody>
    @php /** @var Region $region */use App\Models\Adverts\Region; @endphp
    @foreach ($regions as $region)
        <tr>
            <td><a href="{{ route('admin.adverts.regions.show', $region) }}">{{ $region->name }}</a></td>
            <td>{{ $region->slug }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
