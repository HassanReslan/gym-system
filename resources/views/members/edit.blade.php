@extends('layouts.master')
@section('title', 'Edit Memebrs') 
@section('content')
<div class="container">
<h1>Edit Member </h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('members.update',$member) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{old('name', $member->name)}}" placeholder="Enter full name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{old('email', $member->email)}}" placeholder="Enter email" required>
        </div>

        <div class="form-group">
            <label for="phone">Date Of Birht</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value={{old('date_of_birth', $member->date_of_birth)}} date_of_birth="date_of_birth" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value={{old('phone', $member->phone)}}  placeholder="Enter phone number" required>
        </div>
        <div class="custom-file-upload">
            <input type="file" id="imageInput"   type="file" name="image"   accept="image/*" />
            <label for="imageInput">
            <span class="upload-icon">📷</span>
            <span class="upload-text">Choose an image</span>
            </label>
        </div>
    
        <div id="imagePreviewWrapper" style="position: relative; display: ;">
            @if($member->image)
            <img id="previewImage" src="{{ asset('uploads/members/' . $member->image) }}" alt="Image Preview" style="max-width: 150px; border-radius: 8px;">
            @else
            <img id="previewImage" src="#" alt="Image Preview" style="max-width: 150px; border-radius: 8px; display: none;">
            @endif

            <p id="cancelUploadBtn" style="cursor: pointer"><span style="color:red">X</span> Cancel Upload</p>
        </div>
        <div id="progressContainer" style="display:none; margin-top: 1rem; background: #1a1a1a; border-radius: 6px;">
            <div id="progressBar" style="height: 20px; background: #4ade80; width: 0%; border-radius: 6px;"></div>
        </div>

        <div id="uploadStatus" style="margin-top: 1rem; color: #fff;" ></div>
        <!--<div class="form-group">
            <label for="membership">Membership Type</label>
            <select id="membership" name="membership" required>
            <option value="">-- Select --</option>
            <option value="Basic">Basic</option>
            <option value="Gold">Gold</option>
            <option value="Premium">Premium</option>
            </select>
        </div>-->

        <!--<div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="overdue">Overdue</option>
            <option value="inactive">Inactive</option>
            </select>
        </div>-->

    <button type="submit">Save</button>
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
          uploadUrl: "{{ route('members.upload-image') }}",
          submitBtnId: 'submitBtn',
          prevId: 'previewImage',
        });
      });

      
        </script>
@endsection
