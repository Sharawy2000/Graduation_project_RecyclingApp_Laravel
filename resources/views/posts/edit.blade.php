@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{asset('css/edit_post.css')}}" rel="stylesheet">
</head>
<form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data" class="styled-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="material">Material:</label>
        <input type="text" name="material" id="material" class="form-control" value="{{ $post->material }}" required>
        @error('material')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $post->description }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" class="form-control" value="{{ $post->price }}" required>
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="pending" {{ $post->status === 'pending' ? 'selected' : '' }}>pending</option>
            <option value="approved" {{ $post->status === 'approved' ? 'selected' : '' }}>approved</option>
            <option value="rejected" {{ $post->status === 'rejected' ? 'selected' : '' }}>rejected</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="reject_reason">Reject Reason:</label>
        <textarea name="reject_reason" id="reject_reason" class="form-control" rows="3">{{ $post->reject_reason }}</textarea>
        @error('reject_reason')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
        <img src="{{ url($post->image) }}" alt="Post Image" class="post-image">
        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <!-- Add other fields here -->
    <button type="submit" class="btn btn-primary">Update</button>
    <a style="margin:20px" class="btn btn-primary" href="{{route('dashboard')}}"><strong>Back</strong></a>
</form>
@endsection

