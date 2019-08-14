{{-- Вывод списка уведомлений --}}
@if(!is_null(session('message')))
    @foreach(session('message') as $message)
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endif
