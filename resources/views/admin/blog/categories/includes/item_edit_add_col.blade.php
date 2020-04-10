<div class="row justify-content-center">
    <div class="col-12">
        <div class="cart">
            <div class="cart-body">
                <input type="submit" class="btn btn-primary" value="Сохранить">
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
                    <li>ID: {{ $item->id }}</li>
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
                    <label for="">Создано</label>
                    <input type="text" class="form-control" value="{{ $item->created_at }}">
                </div>
                <div class="form-group">
                    <label for="">Изменено</label>
                    <input type="text" class="form-control" value="{{ $item->updated_at }}">
                </div>
                <div class="form-group">
                    <label for="">Удалено</label>
                    <input type="text" class="form-control" value="{{ $item->deleted_at }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
