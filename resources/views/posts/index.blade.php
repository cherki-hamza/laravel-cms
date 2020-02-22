@extends('layouts.app')

@section('content')

    <div class="container-fluid">
{{--        @if($message = Session::get('success'))--}}
{{--            <div class="my-2 alert alert-success">--}}
{{--                {{$message}}--}}
{{--            </div>--}}
{{--        @elseif($message = Session::get('danger'))--}}
{{--            <div class="my-2 alert alert-success">--}}
{{--                {{$message}}--}}
{{--            </div>--}}
{{--        @endif--}}
        <h3 class="text-primary"> All Posts Dashboard</h3>
        <span class="float-right my-3"><a class="btn btn-success" href="{{route('posts.create')}}"><i class="fal fa-layer-plus fa-spin mr-2"></i>Add New Post</a></span>

        <div class="my-2">
            <div class="my-3">
                @if($message = Session::get('success'))
                    <div class="alert alert-success">{{$message}}</div>
                @endif
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                <tr class="bg-info">
                    <td><i class="fal fa-archive mr-2"></i>#id</td>
                    <td><i class="fal fa-archive mr-2"></i>post title</td>
                    <td><i class="fal fa-archive mr-2"></i>post description</td>
{{--                    <td><i class="fal fa-archive mr-2"></i>post cat</td>--}}
                    <td><i class="fal fa-archive mr-2"></i>post content</td>
                    <td><i class="fal fa-archive mr-2"></i>post image</td>
                    <td><i class="fal fa-archive mr-2"></i>cat_id</td>
                    <td><i class="fal fa-archive mr-2"></i>cat_name</td>
                    <td><i class="fal fa-archive mr-2"></i>Action</td>
                </tr>
                </thead>
                <tbody>
                  @forelse($posts as $post)
                      <tr>
                          <td>{{$post->id}}</td>
                          <td>{{$post->title}}</td>
                          <td style="border-bottom-color: darkgreen;">{{$post->description}}</td>
                          <td>{!!$post->content!!}</td>
                          <td><img style="width: 100px;height: 50px;" class="img-thumbnail" src="{{ asset('storage/'.$post->image) }}" alt="{{ asset('storage/'.$post->image) }}" /></td>
                          <td>{{$post->category_id}}</td>
                          <td style="color: gold;border-bottom-color: #1f6fb2;">{{$post->category->name}}</td>
                          <td>
                          <div class="row float-right">
                              @if(!$post->trashed())
                              <span class="mb-2"><a href="{{route('posts.edit' , $post->id)}}"><i class="fal fa-edit text-success mr-2"></i>edit</a></span>
                                  <span class="text-primary">|</span>
                              @else
                                  <span class="mb-2"><a href="{{route('trashed.restore' , $post->id)}}"><i class="fal fa-edit text-warning mr-2"></i>Restore</a></span>
                              @endif

                                  <form action="{{route('posts.destroy' , $post->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <span class="mb-2"><button class="btn text-danger"><i class="fal fa-trash mr-2"></i>
                                          {{ $post->trashed()? 'Delete':'Trash' }}
                                      </button></span>
                                  </form>
                          </div>
                          </td>

                      </tr>
                  @empty
                      <tr>
                          <td colspan="6" class="alert alert-danger text-center my-5">Ops not post found he're</td>
                      </tr>
                  @endforelse

                </tbody>
            </table>
        </div>

    </div>

@endsection
