<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Trainer;
use Illuminate\Support\Facades\File;

class TrainerController extends Controller
{
    public function index()
    {
        
        $trainers = Trainer::latest()->paginate(10);
       
        return view('trainers.index', compact('trainers'));
      
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:trainers,email',
            'salary' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:500000',
            
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
 
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/trainers'), $imageName);
           
        }

        Trainer::create([
            'name' => $request->name,
            'specialty'=> $request->specialty,
            'phone'=> $request->phone,
            'email'=> $request->email ,
            'salary'=> $request->salary ,
            'image'=>  $imageName,
            'notes'=> $request->notes ,
            'status'=> $request->status ,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer added successfully!');
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
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
        $trainer = Trainer::findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($trainer->image && file_exists(public_path('uploads/trainers/' . $trainer->image))) {
                unlink(public_path('uploads/trainers/' . $trainer->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/members'), $filename);
            $trainer->image = $filename;
            $trainer->save();
        }

        return response()->json(['success' => true, 'filename' => $filename]);
    }

    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:trainers,email,' . $trainer->id,
            'salary' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:500000',
        ]);

         // Handle image upload if provided
         if ($request->hasFile('image'))
         {
            // Delete old image if exists
            if ($trainer->image && File::exists(public_path('uploads/trainers/' . $trainer->image))) {
                File::delete(public_path('uploads/trainers/' . $trainer->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/trainers'), $imageName);

            // Save new image name
            $trainer->image = $imageName;
        }
        else{
            $imageName =  $trainer->image;
        }

        $trainer->update([
            'name' => $request->name,
            'specialty'=> $request->specialty,
            'phone'=> $request->phone,
            'email'=> $request->email ,
            'salary'=> $request->salary ,
            'image'=>  $imageName,
            'notes'=> $request->notes ,
            'status'=> $request->status ,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully!');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return redirect()->route('trainers.index')->with('success', 'The Trainer has been deleted');
    }
}
