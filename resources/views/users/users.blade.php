@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{asset('css/styleUser.css')}}" rel="stylesheet">
</head>

@foreach ($users as $user )

    <div style="margin: 10px" class="user">
        <div class="user-header">
            <div class="user-info">
                <img class="user-image" src="{{$user->image}}" onerror="this.src='{{url('adminassets/img/avatars/User_icon_2.png')}}'" alt="image">
                <div style="margin-right: 20px">
                    <h2 class="user-name">{{$user->name}}</h2>
                    <p class="user-email">{{$user->email}}</p>
                    <p class="user-role">{{$user->user_type}}</p>
                </div>
            </div>
            <div class="user-buttons">
                
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
                <form action="{{route('user.delete',$user)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    
    
@endforeach
@endsection