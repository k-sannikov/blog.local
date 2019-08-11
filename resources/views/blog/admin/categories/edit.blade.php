@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('blog.admin.categories.update', $item->id) }}">
        @method('put')
        @csrf
        <div class="container">
            @if(!is_null($errors->all()))
            @foreach($errors->all() as $error)
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
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

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.categories.includes.item_edit_add_col')
                </div>
            </div>
        </div>

    </form>
@endsection
