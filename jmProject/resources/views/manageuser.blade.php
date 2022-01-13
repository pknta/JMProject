@extends('layouts.app')

@section('content')

<div class="container">

    <div class="container text-center">
        <h2> Manage Users </h2>
    </div>

    <div class="container">
        <div class="row">
            @foreach($users as $user)
            <div class="col-sm-6 my-2">
                <div class="card rounded col-sm-12 p-0">
                    <div class="card-header">
                        <p class="card-text"> {{$user->id." | ".$user->name}} </p>
                    </div>
                    <div class="card-body">
                        <a href="{{route('user.history', ['staff_id'=>$user->id])}}" class="btn btn-primary form-control"> View Transaction History </a>
                        <form method="POST" action="{{route('user.delete', ['user_id'=>$user->id])}}">
                            @method('DELETE')
                            @csrf
                                <button type="submit" class="btn btn-danger form-control"> Delete </a>
                        </form>
                    </div>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
</div>
@endsection