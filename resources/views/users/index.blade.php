@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')

<div class="container-fluid">
 <h1 class="text-success">hello Users<span class="float-right"><a href="{{route('users.create')}}" class="btn btn-primary">Add new user</a></span></h1>

    <div class="my-2">
        @if($message = Session()->get('success'))
           <div class="my-2 alert alert-success font-weight-bold">
                   {{$message}}
           </div>
        @endif
        <table class="table table-hover table-bordered">
            <thead>
            <tr class="bg-info">
                <td><i class="fal fa-archive mr-2"></i>#id</td>
                <td><i class="fal fa-archive mr-2"></i>Avatar</td>
                <td><i class="fal fa-archive mr-2"></i>User name</td>
                <td><i class="fal fa-archive mr-2"></i>User email</td>
                <td><i class="fal fa-archive mr-2"></i>User permission</td>
                <td><i class="fal fa-archive mr-2"></i>Change Permission</td>
                <td><i class="fal fa-archive mr-2"></i>Actions</td>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td id="{{$user->hasPicture()}}" class="text-center"><img src="{{$user->hasPicture()? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" style="border-radius: 50%; width: 50px;height: 50px;" /></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        @if(!$user->isAdmin())
                            <form action="{{route('users.make-admin' , $user->id)}}" method="POST">
                                @csrf
                                <span class="row text-center offset-2">
                                    <span class=""><button type="submit" class="btn btn-primary">Change to Admin</button></span>
                                </span>
                            </form>
                        @elseif($user->isAdmin())
                            <form action="{{route('users.make-writer' , $user->id)}}" method="POST">
                                @csrf
                                <span class="row text-center offset-2">
                                    <span class=""><button type="submit" class="btn btn-success">Change to Writer</button></span>
                                </span>
                            </form>
                        @else
                            {{$user->role}}
                        @endif

                    </td>
                    <td>Actions</td>
                </tr>

            @empty
                <tr><span class="text-success">No User yet</span></tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

@section('scripts')

@endsection
