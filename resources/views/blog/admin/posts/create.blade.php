@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('blog.admin.posts.store') }}">
        @csrf
        <div class="container">
            @include('blog.admin.categories.includes.result_messages')
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
@endsection
