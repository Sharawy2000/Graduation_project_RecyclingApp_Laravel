@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{asset('css/styleUser.css')}}" rel="stylesheet">
</head>
<a href="{{ route('categories.create') }}" style="background-color: #27B645;margin:20px;" class="btn btn-primary"><strong>Add</strong></a>

@foreach ($categories as $category )

    <div style="margin: 10px" class="user">
        <div class="user-header">
            <div class="user-info">
                {{-- <a href="{{ route('categories.edit', $category) }}" style="background-color: #27B645;" class="btn btn-primary"><strong>Edit</strong></a> --}}

                {{-- <img class="user-image" src="{{$user->image}}" onerror="this.src='{{url('adminassets/img/avatars/User_icon_2.png')}}'" alt="image"> --}}
                <div style="margin-right: 20px">
                    <h2 class="user-name">{{$category->name}}</h2>
                    <p class="user-email">{{$category->price}}LE</p>
                    
                </div>
            </div>
            <div class="user-buttons">
                
                <a href="{{ route('categories.edit', $category) }}" style="background-color: #27B645;" class="btn btn-primary"><strong>Edit</strong></a>
                <form action="{{route('category.delete',$category)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    
    
@endforeach
@endsection