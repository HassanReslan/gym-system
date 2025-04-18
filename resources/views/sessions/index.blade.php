@extends('layouts.app')

@section('content')
<div class="container">
    <h1>قائمة الجلسات</h1>

    <a href="{{ route('sessions.create') }}">➕ إضافة جلسة جديدة</a>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10" style="margin-top: 20px; width: 100%;">
        <thead>
            <tr>
                <th>العضو</th>
                <th>المدرب</th>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th>النوع</th>
                <th>الحالة</th>
                <th>تحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->member->name ?? '—' }}</td>
                    <td>{{ $session->trainer->name ?? '—' }}</td>
                    <td>{{ $session->date }}</td>
                    <td>{{ $session->time }}</td>
                    <td>{{ $session->type == 'individual' ? 'فردية' : 'جماعية' }}</td>
                    <td>{{ $session->status }}</td>
                    <td>
                        <a href="{{ route('sessions.edit', $session) }}">تعديل</a> |
                        <form action="{{ route('sessions.destroy', $session) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $sessions->links() }}
</div>
@endsection
