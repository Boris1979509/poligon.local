@php /** @var App\Models\Blog\BlogCategory $item */@endphp
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">{{ __('Data') }}</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" value="{{ $item->title }}"
                                   class="form-control @error('title') is-invalid @enderror" {{ old('title', $item->title) }}>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ $item->slug }}" {{ old('slug', $item->slug) }}>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">{{ __('Parent') }}</label>
                            <select name="parent_id" id="parent_id"
                                    class="form-control">
                                @php /** @var BlogCategory $categoryItem*/use App\Models\Blog\BlogCategory; @endphp
                                @foreach($categoryList as $categoryItem)
                                    <option value="{{ $categoryItem->id }}"
                                            @if($item->parent_id === $categoryItem->id) selected @endif>{{
                                        $categoryItem->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      id="description" cols="30"
                                      rows="10">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
