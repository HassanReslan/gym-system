<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(10);
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Plan::create($request->all());

        return redirect()->route('plans.index')->with('success', 'تمت إضافة الباقة بنجاح!');
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'تم تحديث الباقة بنجاح!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'تم حذف الباقة.');
    }
}
