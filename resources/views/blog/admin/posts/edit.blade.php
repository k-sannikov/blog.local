@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('blog.admin.posts.update', $item->id) }}">
        @method('put')
        @csrf
        <div class="container">
            @include('blog.admin.posts.includes.result_messages')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.posts.includes.post_form_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.posts.includes.post_form_add_col')
                </div>
            </div>
        </div>
    </form>
    <br>
    <form method="post" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
        @method('delete')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-block">
                        <div class="card-body ml-auto">
                            <button type="submit" class="btn btn-link">Удалить</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>
@endsection
