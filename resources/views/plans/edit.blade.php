@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل الباقة</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plans.update', $plan) }}" method="POST">
        @csrf
        @method('PUT')

        <label>الاسم:</label><br>
        <input type="text" name="name" value="{{ old('name', $plan->name) }}"><br><br>

        <label>السعر:</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price', $plan->price) }}"><br><br>

        <label>المدة (أيام):</label><br>
        <input type="number" name="duration" value="{{ old('duration', $plan->duration) }}"><br><br>

        <label>الوصف:</label><br>
        <textarea name="description">{{ old('description', $plan->description) }}</textarea><br><br>

        <label>الحالة:</label><br>
        <select name="status">
            <option value="active" {{ $plan->status == 'active' ? 'selected' : '' }}>نشطة</option>
            <option value="inactive" {{ $plan->status == 'inactive' ? 'selected' : '' }}>غير نشطة</option>
        </select><br><br>

        <button type="submit">💾 تحديث</button>
    </form>
</div>
@endsection
