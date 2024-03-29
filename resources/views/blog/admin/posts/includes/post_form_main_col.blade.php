<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if (isset($item))
                    @if($item->is_published)
                        Опубликовано
                    @else
                        Черновик
                    @endif
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">
                            Основные данные
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">
                            Доп. данные
                        </a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ $item->title ?? old('title') }}"
                                id="title"
                                type="text"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw"
                                id="content_raw"
                                type="text"
                                class="form-control"
                                rows="20" >{{ $item->content_raw ?? old('content_raw') }}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="parent_id">Категория</label>
                            <select name="category_id"
                                id="category_id"
                                class="form-control"
                                placeholder="Выберите категорию">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                        @if(isset($item))
                                            @if($categoryOption->id == $item->category_id) selected @endif
                                        @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input name="slug" value="{{ $item->slug ?? old('slug') }}"
                                id="slug"
                                type="text"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt"
                                id="excerpt"
                                class="form-control"
                                rows="5">{{ $item->excerpt ?? old('excerpt') }}</textarea>
                        </div>

                        <div class="form-check">
                            <input name="is_published"
                                type="hidden"
                                value="0">

                            <input name="is_published"
                                id="is_published"
                                type="checkbox"
                                class="form-check-input"
                                value="1"
                                @if (isset($item))
                                    @if($item->is_published)
                                        checked="checked"
                                    @endif
                                @endif

                            >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
