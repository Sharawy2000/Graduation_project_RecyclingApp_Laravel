<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Posts</div>

                <div class="card-body">
                    @foreach($posts as $post)
                    <div class="post">
                        <p><strong>Material:</strong> {{ $post->material }}</p>
                        <p><strong>Price:</strong> ${{ $post->price }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
