@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{ asset('css/styleWaiting.css') }}" rel="stylesheet">
</head>
<?php
    use App\Models\User;
?>

@foreach ($posts as $post )

    @if ($post->status=='rejected')

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
                    <form action="{{ route('posts.delete', $post) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <form action="{{ route('posts.restore', $post) }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary"
                                style="background-color: white; color: #27B645; border: 2px solid #27B645;width:85px;height:36.5px;padding:5px;">
                                Restore
                        </button>
                    </form>
                </div>
            </div>
            <div class="rejection-reason">
                <p>Rejection Reason: <strong>{{ $post->reject_reason }}</strong></p>
            </div>
        </div>
    
        
    @endif
@endforeach
@endsection