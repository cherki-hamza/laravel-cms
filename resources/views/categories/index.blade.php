@extends('layouts.app')

@section('content')

<div class="container">
    @if($message = Session::get('success'))
        <div class="my-2 alert alert-success">
            {{$message}}
        </div>
        @elseif($message = Session::get('danger'))
        <div class="my-2 alert alert-danger">
            {{$message}}
        </div>
    @endif
    <h3>welcome to the categories</h3>
    <span class="float-right"><a class="btn btn-success" href="{{route('categories.create')}}"><i class="fal fa-layer-plus fa-spin mr-2"></i>Add New Category</a></span>

        <div class="my-2">
            <table class="table table-hover table-bordered">
                <thead>
                  <tr class="bg-info">
                      <td><i class="fal fa-archive mr-2"></i>#id</td>
                      <td><i class="fal fa-archive mr-2"></i>category name</td>
                      <td><i class="fal fa-archive mr-2"></i>created_at</td>
                      <td><i class="fal fa-archive mr-2"></i>updated_at</td>
                      <td><i class="fal fa-archive mr-2"></i>Action</td>
                  </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                  <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->name}}</td>
                      <td>{{$category->created_at->diffForHumans()}}</td>
                      <td>{{$category->updated_at->diffForHumans()}}</td>
                      <td>
                          <span class="row float-right offset-1">
                              <span class="mr-5"><a href="{{route('categories.edit' , $category->id)}}"><i class="fal fa-edit text-success mr-2"></i>edit</a></span>
                              <span class="mr-5 text-primary">|</span>
                              <span class="mr-5">
                                  <form action="{{route('categories.destroy' , $category->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn text-danger"><i class="fal fa-trash mr-2"></i>Delete</button>
                                  </form>
                              </span>
                          </span>
                      </td>
                  </tr>

    @empty
      <tr><span class="text-success">No categories yet</span></tr>
    @endforelse
                </tbody>
            </table>
        </div>

</div>

@endsection
