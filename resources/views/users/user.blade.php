@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')

 <div class="container-fluid">

   <h3 class="text-primary font-weight-bold text-center my-3">user profile name : {{$user->name}}</h3>
     <div class="row text-center offset-2">
         <div class="card mb-3" style="">
             <div class="row no-gutters">
                 <div class="col-md-4">
                     <img src="{{Auth()->user()->hasPicture()? asset('storage/'.Auth()->user()->getPicture()) : Auth()->user()->getGravatar()}}" class="card-img" alt="...">
                 </div>
                 <div class="col-md-8">
                     <div class="card-body">
                         <h5 class="card-title">{{$user->name}}</h5>
                         <p class="card-text">{{$user->profile->about}}</p>
                         <p class="card-text"><small class="text-muted">Last updated  {{$user->profile->updated_at->diffForHumans()}}</small></p>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>

@endsection

@section('scripts')

@endsection
