@php /** @var App\Models\Blog\BlogPost $item */@endphp
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ ($item->is_published) ? __('Published') : __('Unpublished') }}
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#data" role="tab"
                           aria-controls="home" aria-selected="true">{{ __('Data') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#additional-data" role="tab"
                           aria-controls="home" aria-selected="true">{{ __('Additional data') }}</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" value="{{ $item->title }}"
                                   class="form-control @error('title') is-invalid @enderror" {{ old('title', $item->title) }}>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content_raw">{{ __('Article') }}</label>
                            <textarea class="form-control @error('content_raw') is-invalid @enderror" name="content_raw"
                                      id="content_raw" cols="30"
                                      rows="10">{{ old('content_raw', $item->content_raw) }}</textarea>
                            @error('content_raw')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="additional-data" role="tabpanel"
                         aria-labelledby="home-tab">
                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ $item->slug }}" {{ old('slug', $item->slug) }}>
                        </div>
                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select name="category_id" id="category_id"
                                    class="form-control">
                                @php /** @var BlogCategory $categoryItem*/use App\Models\Blog\BlogCategory; @endphp
                                @foreach($categoryList as $categoryItem)
                                    <option value="{{ $categoryItem->id }}"
                                            @if($item->category_id === $categoryItem->id) selected @endif>{{
                                        $categoryItem->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">{{ __('Excerpt') }}</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror"
                                      name="excerpt"
                                      id="excerpt" cols="30"
                                      rows="10">{{ old('excerpt', $item->excerpt) }}</textarea>
                            @error('excerpt')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" class="form-check-input" name="is_published" id="is_published"
                                   value="1" @if($item->is_published) checked='checked' @endif>
                            <label for="is_published" class="form-check-label">{{ __('Published') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
