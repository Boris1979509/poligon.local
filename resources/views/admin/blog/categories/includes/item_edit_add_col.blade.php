@php /** @var App\Models\Blog\BlogCategory $item */@endphp
<div class="row justify-content-center">
    <div class="col-12">
        <div class="cart">
            <div class="cart-body">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
@if($item->exists)
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="cart">
                <div class="cart-body">
                    <ul class="list-unstyled">
                        <li>{{ __('ID') }}: {{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="cart">
                <div class="cart-body">
                    <div class="form-group">
                        <label for="">{{ __('Created') }}</label>
                        <input type="text" class="form-control" value="{{ $item->created_at }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Updated') }}</label>
                        <input type="text" class="form-control" value="{{ $item->updated_at }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Deleted') }}</label>
                        <input type="text" class="form-control" value="{{ $item->deleted_at }}" disabled="disabled">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
