<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // 🧾 عرض كل الأعضاء
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    // ➕ عرض نموذج إضافة عضو جديد
    public function create()
    {
        return view('members.create');
    }

    // 💾 حفظ عضو جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
        ]);

        Member::create($request->all());

        return redirect()->route('members.list')
                         ->with('success', 'تمت إضافة العضو بنجاح');
    }

    // 🖊️ عرض نموذج تعديل عضو
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    // 🛠️ تحديث بيانات عضو
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
        ]);

        $member->update($request->all());

        return redirect()->route('members.list')
                         ->with('success', 'تم تحديث بيانات العضو');
    }

    // 🗑️ حذف عضو
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.list')
                         ->with('success', 'تم حذف العضو');
    }
}
