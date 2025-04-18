@extends('layouts.master')
@section('title', 'Subscriptions') 
@section('content')
<div class="container">
    <h1></h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf

        <label>Member:</label>
        <select name="member_id">
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select><br><br>

        <label>Subsctiption Type</label>
        <input type="text" name="type" value="{{ old('type') }}"><br><br>
        <label>Pprice:</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}"><br><br>

        <label>Start date:</label>
        <input type="date" name="start_date" value="{{ old('start_date') }}"><br><br>

        <label>End date:</label><br><br>
        <input type="date" name="end_date" value="{{ old('end_date') }}"><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="active">Active</option>
            <option value="expired">Expired</option>
        </select><br><br>

        <button type="submit">Save</button>
    </form>
</div>
@endsection
