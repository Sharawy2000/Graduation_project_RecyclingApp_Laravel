@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
</head>

<div class="profile-container">
    <div class="profile-header">
        <h2>Admin Profile</h2>
    </div>
    <div class="profile-info">
        <div class="avatar">
            <img src="{{url('adminassets/img/avatars/images.png')}}" alt="Admin Avatar">
        </div>
        <div class="details">
            <p><strong>Name:</strong> {{$admin->name}}</p>
            <p><strong>Email:</strong> {{$admin->email}}</p>
            <p><strong>Role:</strong> Administrator</p>
            <p><strong>Last Login:</strong> {{$admin->created_at}}</p>
            <!-- Add more details as needed -->
        </div>
    </div>
</div>

@endsection