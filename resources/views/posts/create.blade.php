@extends('layouts.app')

@section('stylesheet')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />--}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__choice{
            color: darkslateblue;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">

                        @if($message = Session::get('success'))
                            <div class="my-2 alert alert-success">
                                {{$message}}
                            </div>
                        @elseif($message = Session::get('danger'))
                            <div class="my-2 alert alert-danger">
                                {{$message}}
                            </div>
                        @endif

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


                    {{-- start category select --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="category">Select Category</label>
                                    <select name="categoryID" id="category"  class="form-control form-control-sm js-example-basic-multiple">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    {{-- end category select --}}

                    @if(!$tags->count() <= 0)
                        {{-- start tag select --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="selectTag">Select Tag</label>
                                    <select name="tags[]" id="selectTag" class="form-control text-success form-control-sm js-example-basic-multiple" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                    @if($post->hasTag($tag->id))
                                                    selected
                                                @endif
                                            >{{$tag->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- end tag select --}}
                    @endif

                    <div class="form-group my-5">
                        <input type="submit" class="btn btn-success" value="{{ isset($post)? 'Update the post':'Add New Post' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous"></script>
 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


@endsection
