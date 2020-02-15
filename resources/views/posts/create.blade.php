@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">

                <h3 class="text-primary">
                    {{ isset($post)? 'Update the post':'Add New Post' }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($post)? route('posts.update' , $post->id): route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                       @method('PUT')
                    @endif
                    <div class="form-group my-5">
                        <label for="title">Title :</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{isset($post)? $post->title:''}}" placeholder="Write the Title">
                    </div>

                    <div class="form-group my-5">
                        <label for="description">Description :</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="2" placeholder="Write the Description">{{isset($post)? $post->description:''}}</textarea>
                    </div>

                    <div class="form-group my-5">

                        <label for="editor">Content :</label>
                        <textarea type="text" class="form-control" id="editor" name="content" rows="3" placeholder="Write the Content">{{isset($post)? $post->content:''}}</textarea>

{{--                        <input id="content" type="hidden" rows="5" class="trix-content" name="content">--}}
{{--                        <trix-editor input="content"></trix-editor>--}}
{{--                          <div id="editor"></div>--}}
{{--                           <label for="editor">Content :</label>--}}
{{--                           <textarea type="text" class="form-control" id="editor" name="content" rows="3" placeholder="Write the Content"></textarea>--}}

                    </div>

                    @if(isset($post))
                        <div class="form-group my-5 text-center">
                            <img src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}" style="width: 40%"/>
                        </div>
                    @endif

                    <div class="form-group my-5">
                        <label for="content">Image :</label>
                        <input type="file" class="form-control bg-info" id="content" name="image">
                    </div>

                    <div class="form-group my-5">
                        <input type="submit" class="btn btn-success" value="{{ isset($post)? 'Update the post':'Add New Post' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
