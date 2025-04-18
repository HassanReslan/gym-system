@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة جلسة جديدة</h1>

    <form action="{{ route('sessions.store') }}" method="POST">
        @csrf

        <label>العضو:</label><br>
        <select name="member_id" required>
            @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select><br><br>

        <label>المدرب:</label><br>
        <select name="trainer_id" required>
            @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
            @endforeach
        </select><br><br>

        <label>التاريخ:</label><br>
        <input type="date" name="date" required><br><br>

        <label>الوقت:</label><br>
        <input type="time" name="time" required><br><br>

        <label>النوع:</label><br>
        <select name="type" required>
            <option value="individual">فردية</option>
            <option value="group">جماعية</option>
        </select><br><br>

        <label>ملاحظات:</label><br>
        <textarea name="notes"></textarea><br><br>

        <label>الحالة:</label><br>
        <select name="status" required>
            <option value="scheduled">مجدولة</option>
            <option value="done">تمت</option>
            <option value="canceled">ملغاة</option>
        </select><br><br>

        <button type="submit">💾 حفظ</button>
    </form>
</div>
@endsection
