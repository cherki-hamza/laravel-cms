@extends('layouts.app')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">

            <h3 class="text-primary">
                {{ isset($category)? 'Update Category' : 'Create New Category' }}
            </h3>
        </div>
        <div class="card-body">
          <form action="{{ isset($category)? route('categories.update' , $category->id) : route('categories.store') }}" method="POST">
              @csrf
              @if(isset($category))
                  @method('PUT')
              @endif
              <div class="form-group">
                  @if($message = Session::get('success'))
                  <div class="alert alert-success">{{$message}}</div>
                  @endif
              </div>
              <div class="form-group my-5">
                  <label for="name">Categories Name :</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{isset($category)? $category->name: '' }}" placeholder="Write the categories">
              </div>
              <div class="form-group">
                  @error('name')
                  <div class="alert alert-danger mt-5">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group my-5">
                  <input type="submit" class="btn btn-{{ isset($category)? 'success' : 'primary' }}" value="{{ isset($category)? 'Update the Category' : 'Add New Category' }}">
              </div>
          </form>
        </div>
    </div>
</div>
@endsection
