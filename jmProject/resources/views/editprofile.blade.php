@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-between">

            <div class="user-profile">
                <p>Admin Name : {{Auth::user()->name}}</p>
                <p>Admin Email : {{Auth::user()->email}}</p>
                <p>Admin Age : {{Auth::user()->usia}}</p>
                <p>Admin Shift : {{Auth::user()->shift}}</p>
            </div>

                {{-- picture --}}

                <div class="picture">

                    @if(Auth::user()->image)
                    <img class="image rounded-circle" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="profile_image" style="width: 200px;height: 200px; padding: 10px; margin: 0px; ">
                    @endif

                    <div class="card-body">
                        <form action="{{route('editprofile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image">
                            <input type="submit" value="Upload">
                        </form>
                    </div>
                </div>

        </div>
        </div>
        {{-- belom link --}}
        <div class="row mb-0 justify-content-center">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    <a href="{{ url('/home') }}" style="text-decoration:none; color:white">
                        {{ __('Back') }}
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
