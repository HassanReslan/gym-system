<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Member;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('member')->latest()->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $members = Member::all();
        return view('subscriptions.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subsciprion added successfully!');
    }

    public function edit(Subscription $subscription)
    {
        $members = Member::all();
        return view('subscriptions.edit', compact('subscription', 'members'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully!');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', ' The Subscription has been deleted ');
    }
}

