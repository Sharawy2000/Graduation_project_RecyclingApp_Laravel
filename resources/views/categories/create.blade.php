@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{asset('css/edit_post.css')}}" rel="stylesheet">
</head>
<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" class="styled-form">
    @csrf
    {{-- @method('CREATE') --}}
    <div class="form-group">
        <label for="material">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
        @error('material')
            <div class="error">{{ $message }}</div>
        @enderror
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" class="form-control" required>
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <!-- Add other fields here -->
    <button style="background-color:#27B645" type="submit" class="btn btn-primary">Create</button>
    <a style="margin:10px" class="btn btn-primary" href="{{route('categories')}}"><strong>Back</strong></a>
</form>
@endsection