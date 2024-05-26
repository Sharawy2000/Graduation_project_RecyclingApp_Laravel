@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
</head>

<div class="profile-container">
    <div class="profile-header">
        <h2>User Profile</h2>
    </div>
    <div class="profile-info">
        <div class="avatar">
            <img class="user-image" src="{{$user->image}}" 
            onerror="this.src='{{url('adminassets/img/avatars/User_icon_2.png')}}'" alt="image">
        </div>
        <div class="details">
            <p><strong>Name:</strong> {{$user->name}}</p>
            <p><strong>Email:</strong> {{$user->email}}</p>
            <p><strong>User Type:</strong> {{$user->user_type}}</p>
            <p><strong>Last Login:</strong> {{$user->created_at}}</p>
            <!-- Add more details as needed -->
        </div>
    </div>
</div>

@endsection