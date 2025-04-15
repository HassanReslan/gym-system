@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Member</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>
   
        <label>Phone</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>Date Of Birth/label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"><br><br>

        <button type="submit">💾 Save</button>
    </form>
</div>
@endsection
