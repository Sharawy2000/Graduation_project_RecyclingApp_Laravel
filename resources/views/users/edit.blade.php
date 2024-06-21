@extends('Dashboard.layouts.layout')
@section('body')
<head>
    <link href="{{asset('css/edit_user.css')}}" rel="stylesheet">
</head>
<form action="{{ route('user.update', $user) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="text">Name</label>
    <input type="text" name="name" value="{{ $user->name }}">
    <label for="text">Email</label>
    <input type="email" name="email" value="{{ $user->email }}" readonly>
    <label for="text">Address</label>
    <input type="text" name="address" value="{{ $user->address }}">
    <label for="text">Phone Number</label>
    <input type="text" name="phone_number" value="{{ $user->phone_number }}" readonly>
    @error('phone_number')
        <div class="error">{{ auth()->attempt($data->validated()) }}</div>
    @enderror


    <label for="status">User Type</label>
    <select name="user_type" id="status" class="form-control" required>
        <option value="Seller" {{ $user->user_type === 'Seller' ? 'selected' : '' }}>Seller</option>
        <option value="Customer" {{ $user->user_type === 'Customer' ? 'selected' : '' }}>Customer</option>
        <option value="Guest" {{ $user->user_type === 'Guest' ? 'selected' : '' }}>Guest</option>
    </select>

    
    <button style="background-color:#27B645" type="submit" class="btn btn-primary">Update</button>
    
    <a style="margin:5px" class="btn btn-primary" href="{{ route('users') }}"><strong>Back</strong></a>

    
</form>
@endsection