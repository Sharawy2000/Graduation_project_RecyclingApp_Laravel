@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{ asset('css/styleWaiting.css') }}" rel="stylesheet">
</head>
<?php
    use App\Models\User;
?>

@foreach ($posts as $post )
    @if ($post->available==false)

        <div class="post" style="margin: 20px">
            <div class="post-header">
                <div class="post-info">
                    <div class="image-container">
                        <img  class="post-image" src="{{$post->image}}" alt="Post Image" width="50px" height="50px">
                    </div>
                    <div class="post-details">
                        <h2 class="post-title">{{$post->material}}</h2>
                        <p class="post-content">{{$post->description}}</p>
                        <p class="post-author">@php
                            $user=User::where('id',$post->user_id)->first();
                            echo $user->name;
                        @endphp</p>
                        <!-- Add more post details as needed -->
                    </div>
                </div>
            </div>
        
        </div>
    
        
    @endif
@endforeach
@endsection