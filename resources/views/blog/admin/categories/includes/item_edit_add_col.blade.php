@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Создано</label>
                        <input type="text" value="{{ $item->craeted_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Изменено</label>
                        <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Удалено</label>
                        <input type="text" value="{{ $item->deleted_at }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endif
