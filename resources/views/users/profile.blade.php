@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span class="text-success">Profile</span>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">{{$message}}</div>
                        @endif
                    </div>

                    <div class="form-group my-5">
                        <label for="name">Name :</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="about">About :</label>
                        <textarea type="text" class="form-control" name="about" id="about" rows="3" placeholder="Write About Us">{{$profile->about}}</textarea>
                    </div>

                    <div class="form-group my-5">
                        <label for="facebook">Facebook :</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$profile->facebook}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="twitter">Twitter :</label>
                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{$profile->twitter}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="github">Github :</label>
                        <input type="text" class="form-control" name="github" id="github" value="{{$profile->github}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="website">Website :</label>
                        <input type="text" class="form-control" name="website" id="website" value="{{$profile->site}}">
                    </div>

                    <div class="form-group my-5">
                        <label for="picture">Picture :</label>
                        <img id="{{$user->hasPicture()}}" src="{{ $user->hasPicture()? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" style="border-radius: 30%; width: 80px;height: 80px;" /><br><hr>
{{--                        <img src="{{$user->getGravatar()}}" style="border-radius: 30%; width: 80px;height: 80px;" /><br><hr>--}}
{{--                        <img src="{{$profile->picture}}" style="border-radius: 30%; width: 80px;height: 80px;" />--}}
                        <input type="file" class="form- my-3" name="picture" id="picture">
                    </div>

                    <div class="form-group my-5">
                        <input type="submit" class="btn btn-primary" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
