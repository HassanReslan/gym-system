<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('members', $filename, 'public');

            return response()->json(['path' => '/storage/' . $path], 200);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    public function uploadImageEdit(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($member->image && file_exists(public_path('uploads/members/' . $member->image))) {
                unlink(public_path('uploads/members/' . $member->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/members'), $filename);
            $member->image = $filename;
            $member->save();
        }

        return response()->json(['success' => true, 'filename' => $filename]);
    }

    // 💾 حفظ عضو جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:500000',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
 
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/members'), $imageName);
           
        }

        Member::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'phone'=>$request->phone,
            'image' => $imageName,
        ]);
        return redirect()->route('members.list')->with('success', 'Member added successfully!');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:500000',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image'))
         {
            // Delete old image if exists
            if ($member->image && File::exists(public_path('uploads/members/' . $member->image))) {
                File::delete(public_path('uploads/members/' . $member->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/members'), $imageName);

            // Save new image name
            $member->image = $imageName;
        }
        else{
            $imageName =  $member->image;
        }

        $member->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'phone'=>$request->phone,
            'image' => $imageName,
        ]);

        return redirect()->route('members.list')
                         ->with('success', 'Member updated successfully!');
    }

    // 🗑️ حذف عضو
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.list')
                         ->with('success', 'The member has been deleted');
    }
}
