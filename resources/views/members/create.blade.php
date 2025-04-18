@extends('layouts.master')
@section('title', 'add new Memebrs') 
@section('content')
<h1>Add New Member</h1>
<form id="memberForm" action="{{ route('members.store') }}" method="POST"  enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter full name" required>
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
    </div>

    <div class="form-group">
        <label for="phone">Date Of Birht</label>
        <input type="date" id="date_of_birth" name="date_of_birth" date_of_birth="date_of_birth" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
    </div>
    <!--<div class="form-group">
        <label for="phone">Image</label>
        <input id="imageInput"  type="file" name="image" accept="image/*" required>
        
    </div>-->
    <div class="custom-file-upload">
        <input type="file" id="imageInput"   type="file" name="image" accept="image/*" required/>
        <label for="imageInput">
          <span class="upload-icon">📷</span>
          <span class="upload-text">Choose an image</span>
        </label>
      </div>
   
    <div id="imagePreviewWrapper" style="position: relative; display: none;">
        <img id="previewImage" src="" alt="Image Preview" style="max-width: 150px; border-radius: 8px;">
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

    <button type="submit" id="submitBtn" >Add Member</button>
    </form>
    
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
        submitBtnId: 'submitBtn'
        });
    });
    </script>
@endsection
