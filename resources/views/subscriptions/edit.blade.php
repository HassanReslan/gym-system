@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Subscription </h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Member:</label>
        <select name="member_id">
            @foreach($members as $member)
                <option value="{{ $member->id }}" {{ $member->id == $subscription->member_id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Subscription Type :</label>
        <input type="text" name="type" value="{{ old('type', $subscription->type) }}"><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $subscription->price) }}"><br><br>

        <label>Start Date :</label>
        <input type="date" name="start_date" value="{{ old('start_date', $subscription->start_date) }}"><br><br>

        <label>End date :</label>
        <input type="date" name="end_date" value="{{ old('end_date', $subscription->end_date) }}"><br><br>

        <label>Status:</label><br><br>
        <select name="status">
            <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired</option>
        </select>

        <button type="submit">💾 Update</button>
    </form>
</div>
@endsection
