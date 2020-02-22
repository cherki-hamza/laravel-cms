@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">

                <h3 class="text-primary">
                    {{ isset($tag)? 'Update Tag' : 'Create New Tag' }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($tag)? route('tags.update' , $tag->id) : route('tags.store') }}" method="POST">
                    @csrf
                    @if(isset($tag))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">{{$message}}</div>
                        @endif
                    </div>
                    <div class="form-group my-5">
                        <label for="tag">Tags Name :</label>
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" name="name" id="tag" value="{{isset($tag)? $tag->name: '' }}" placeholder="Write the new Tags">
                    </div>
                    <div class="form-group">
                        @error('tag')
                        <div class="alert alert-danger mt-5">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <input type="submit" class="btn btn-{{ isset($tag)? 'success' : 'primary' }}" value="{{ isset($tag)? 'Update the tag' : 'Add New tag' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
