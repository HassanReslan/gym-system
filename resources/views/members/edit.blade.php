@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit the members {{ $member->name }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name', $member->name) }}"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email', $member->email) }}"><br><br>

        <label>Phone</label><br>
        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"><br><br>

        <label>Date Of Birth/label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth) }}"><br><br>

        <button type="submit">💾 Update</button>
    </form>
</div>
@endsection
