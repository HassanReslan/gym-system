<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['member', 'trainer'])->latest()->paginate(10);
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        $members = Member::all();
        $trainers = Trainer::all();
        return view('sessions.create', compact('members', 'trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|in:individual,group',
            'status' => 'required|in:scheduled,done,canceled',
        ]);

        Session::create($request->all());

        return redirect()->route('sessions.index')->with('success', 'تمت إضافة الجلسة بنجاح');
    }

    public function edit(Session $session)
    {
        $members = Member::all();
        $trainers = Trainer::all();
        return view('sessions.edit', compact('session', 'members', 'trainers'));
    }

    public function update(Request $request, Session $session)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|in:individual,group',
            'status' => 'required|in:scheduled,done,canceled',
        ]);

        $session->update($request->all());

        return redirect()->route('sessions.index')->with('success', 'تم تعديل الجلسة بنجاح');
    }

    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')->with('success', 'تم حذف الجلسة');
    }
}
