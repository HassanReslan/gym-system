@extends('layouts.app')

@section('content')
<div class="container">
    <h1>List Of Members</h1>

    @if (session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <a href="{{ route('members.create') }}">➕ Add new member</a>

    <table border="1" cellpadding="10" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date Of Birth </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->date_of_birth }}</td>
                    <td>
                        <a href="{{ route('members.edit', $member) }}">تعديل</a> |
                        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are You Sure ?')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $members->links() }}
    </div>
</div>
@endsection
