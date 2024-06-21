@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<?php
    use App\Models\User;
?>

@foreach ($posts as $post )
    @if ($post->status=='approved')
        <div class="post" style="margin: 20px">
            <div class="post-header">
                <h2 class="post-title">{{$post->material}}</h2>
                <div class="post-buttons">
                    {{-- <button class="edit-button">Edit</button> --}}
                    <a href="{{ route('posts.edit', $post) }}" style="background-color: #27B645" class="btn btn-primary"><strong> Edit</strong></a>
                </div>
            </div>
            <img class="post-image" src="{{$post->image}}" alt="Post Image" height="150px" width="150px">
            <p class="post-content">{{$post->description}}</p>
            <p class="post-author">@php
                $user=User::where('id',$post->user_id)->first();
                echo $user->name;
            @endphp</p>
            <!-- Add more elements as needed, such as date, tags, etc. -->
        </div>
    @endif
     
@endforeach
@endsection