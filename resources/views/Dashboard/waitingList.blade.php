@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{ asset('css/styleWaiting.css') }}" rel="stylesheet">
</head>
<?php
    use App\Models\User;
?>

@foreach ($posts as $post )
    @if ($post->status=='pending')

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
                <div class="admin-actions">
                    <form action="{{ route('posts.accept', $post) }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>
                    {{-- <button class="accept-button">Accept</button> --}}

                    <form action="{{ route('posts.reject', $post) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Use PUT method -->
                        <button type="submit" class="btn btn-danger">Reject</button>
                        <div style="padding: 20px " class="rejection-reason">
                            <label for="reject_reason{{ $post->id }}">Reject Reason:</label>
                            <textarea name="reject_reason" id="reject_reason{{ $post->id }}" class="form-control" rows="1" required></textarea>
                            @error('reject_reason')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                    
                </div>
            </div>
        
        </div>
    
        
    @endif
@endforeach
@endsection