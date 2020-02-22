@extends('layouts.app')

@section('content')

    <div class="container">
        @if($message = Session::get('success'))
            <div class="my-2 alert alert-success font-weight-bold">
                {{$message}}
            </div>
        @elseif($message = Session::get('danger'))
            <div class="my-2 alert alert-danger font-weight-bold">
                {{$message}}
            </div>
        @elseif($message = Session::get('error'))
            <div class="my-2 alert alert-danger font-weight-bold">
                {{$message}}
            </div>
        @endif
        <h3>welcome to the Tags</h3>
        <span class="float-right"><a class="btn btn-success" href="{{route('tags.create')}}"><i class="fal fa-layer-plus fa-spin mr-2"></i>Add New Tag</a></span>

        <div class="my-2">
            <table class="table table-hover table-bordered">
                <thead>
                <tr class="bg-info">
                    <td><i class="fal fa-archive mr-2"></i>#id</td>
                    <td><i class="fal fa-archive mr-2"></i>tag name</td>
                    <td><i class="fal fa-archive mr-2"></i>created_at</td>
                    <td><i class="fal fa-archive mr-2"></i>updated_at</td>
                    <td><i class="fal fa-archive mr-2"></i>Action</td>
                </tr>
                </thead>
                <tbody>
                @forelse($tags as $tag)
                    <tr>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->name}}<span class="badge badge-success text-danger font-weight-bold float-right">{{$tag->posts->count()}}<strong class="text-dark">Posts</strong></span></td>
                        <td>{{$tag->created_at->diffForHumans()}}</td>
                        <td>{{$tag->updated_at->diffForHumans()}}</td>
                        <td>
                          <span class="row float-right offset-1">
                              <span class="mr-5"><a href="{{route('tags.edit' , $tag->id)}}"><i class="fal fa-edit text-success mr-2"></i>edit</a></span>
                              <span class="mr-5 text-primary">|</span>
                              <span class="mr-5">
                                  <form action="{{route('tags.destroy' , $tag->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn text-danger"><i class="fal fa-trash mr-2"></i>Delete</button>
                                  </form>
                              </span>
                          </span>
                        </td>


                @empty
                    <td colspan="5" class="text-center text-danger font-weight-bold">No Tags yet</td>
                @endforelse
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection
