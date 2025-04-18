@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة باقة جديدة</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf

        <label>الاسم:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>السعر:</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}"><br><br>

        <label>المدة (أيام):</label><br>
        <input type="number" name="duration" value="{{ old('duration') }}"><br><br>

        <label>الوصف:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <label>الحالة:</label><br>
        <select name="status">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>نشطة</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>غير نشطة</option>
        </select><br><br>

        <button type="submit">💾 حفظ</button>
    </form>
</div>
@endsection
