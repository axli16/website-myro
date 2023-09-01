@extends('layout')
@section('title','Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ $user->profile_pic }}" alt="Profile Picture" class="img-thumbnail">
                    </div>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Authorization Level:</strong> {{ $user->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data">
            @csrf
                <input type="file" name="profile_picture">
                <button type="submit">Upload Profile Picture</button>
            </form>
        </div>
    </div>
</div>
@endsection