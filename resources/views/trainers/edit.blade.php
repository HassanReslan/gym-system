@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Trainer </h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trainers.update', $trainer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $trainer->name) }}"><br><br>

        <label>Specialty:</label>
        <input type="text" name="specialty" value="{{ old('specialty', $trainer->specialty) }}"><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone', $trainer->phone) }}"><br><br>

        <label>Email :</label>
        <input type="email" name="email" value="{{ old('email', $trainer->email) }}"><br><br>

        <label>Salary:</label>
        <input type="number" step="0.01" name="salary" value="{{ old('salary', $trainer->salary) }}"><br><br>
         <!-- upload image input-->
        <div class="custom-file-upload">
            <input type="file" id="imageInput"   type="file" name="image"   accept="image/*" />
            <label for="imageInput">
              <span class="upload-icon">📷</span>
              <span class="upload-text">Choose an image</span>
            </label>
          </div>
       <!-- end of upload image input-->
       <!-- image Preview -->
        <div id="imagePreviewWrapper" style="position: relative; display: ;">
            @if($trainer->image)
            <img id="previewImage" src="{{ asset('uploads/trainers/' . $trainer->image) }}" alt="Image Preview" style="max-width: 150px; border-radius: 8px;">
            @else
            <img id="previewImage" src="#" alt="Image Preview" style="max-width: 150px; border-radius: 8px; display: none;">
            @endif
            <p id="cancelUploadBtn" style="cursor: pointer"><span style="color:red">X</span> Cancel Upload</p>
        </div>
         <!-- end of image Preview -->

        <!--progress bar -->
        <div id="progressContainer" style="display:none; margin-top: 1rem; background: #1a1a1a; border-radius: 6px;">
            <div id="progressBar" style="height: 20px; background: #4ade80; width: 0%; border-radius: 6px;"></div>
        </div>
        <!-- end of progress bar -->

        <!-- upload status-->
        <div id="uploadStatus" style="margin-top: 1rem; color: #fff;" ></div>
        <!-- end of upload status-->

        <label>Notes:</label>
        <textarea cols="48" rows="4" name="notes">{{ old('notes', $trainer->notes) }}</textarea><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="active" {{ $trainer->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $trainer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    setupImageUploader({
    inputId: 'imageInput',
    previewId: 'previewImage',
    previewWrapperId: 'imagePreviewWrapper', // ✅
    cancelBtnId: 'cancelUploadBtn',   
    progressContainerId: 'progressContainer',
    progressBarId: 'progressBar',
    statusId: 'uploadStatus',
    hiddenInputId: 'uploadedImagePath',
    uploadUrl: "{{ route('trainers.upload-image') }}",
    submitBtnId: 'submitBtn'
    });
});
</script>
@endsection
