@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل الجلسة</h1>

    <form action="{{ route('sessions.update', $session) }}" method="POST">
        @csrf
        @method('PUT')

        <label>العضو:</label><br>
        <select name="member_id" required>
            @foreach ($members as $member)
                <option value="{{ $member->id }}" {{ $member->id == $session->member_id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>المدرب:</label><br>
        <select name="trainer_id" required>
            @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}" {{ $trainer->id == $session->trainer_id ? 'selected' : '' }}>
                    {{ $trainer->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>التاريخ:</label><br>
        <input type="date" name="date" value="{{ $session->date }}"><br><br>

        <label>الوقت:</label><br>
        <input type="time" name="time" value="{{ $session->time }}"><br><br>

        <label>النوع:</label><br>
        <select name="type">
            <option value="individual" {{ $session->type == 'individual' ? 'selected' : '' }}>فردية</option>
            <option value="group" {{ $session->type == 'group' ? 'selected' : '' }}>جماعية</option>
        </select><br><br>

        <label>ملاحظات:</label><br>
        <textarea name="notes">{{ $session->notes }}</textarea><br><br>

        <label>الحالة:</label><br>
        <select name="status">
            <option value="scheduled" {{ $session->status == 'scheduled' ? 'selected' : '' }}>مجدولة</option>
            <option value="done" {{ $session->status == 'done' ? 'selected' : '' }}>تمت</option>
            <option value="canceled" {{ $session->status == 'canceled' ? 'selected' : '' }}>ملغاة</option>
        </select><br><br>

        <button type="submit">💾 تحديث</button>
    </form>
</div>
@endsection
