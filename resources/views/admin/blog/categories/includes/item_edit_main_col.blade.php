<div class="row justify-content-center">
    <div class="col-12">
        <div class="cart">
            <div class="cart-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Основные данные</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}">
                        </div> 
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $item->slug }}">
                        </div> 
                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id" placeholder="Выберите категорию" class="form-control">
                                @foreach($categoryList as $cat)
                                <option value="{{ $cat->id }}" @if($item->parent_id === $cat->id) selected @endif>{{ $cat->id . "-" . $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>