function setupImageUploader(config) {
    const {
      inputId,
      previewId,
      progressContainerId,
      progressBarId,
      statusId,
      hiddenInputId,
      uploadUrl,
      submitBtnId,
      previewWrapperId,       // ✅ New: the wrapper div for image + cancel button
      cancelBtnId  ,           // ✅ New: cancel button id
      prevId
    } = config;
  
    const imageInput = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const previewWrapper = document.getElementById(previewWrapperId);
    const cancelBtn = document.getElementById(cancelBtnId);
    const progressContainer = document.getElementById(progressContainerId);
    const progressBar = document.getElementById(progressBarId);
    const status = document.getElementById(statusId);
    const hiddenInput = document.getElementById(hiddenInputId);
    const submitBtn = document.getElementById(submitBtnId);
    const prevID = document.getElementById(prevId);
  
    let xhr = null;
  
    imageInput.addEventListener('change', function () {
      const file = this.files[0];
      if (!file) return;
  
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        previewWrapper.style.display = 'block';
        prevID.style.display = 'block';
      };
      reader.readAsDataURL(file);

     
    
  
      if (submitBtn) submitBtn.disabled = true;
      if (status) status.innerText = '';
      progressBar.style.width = '0%';
      progressContainer.style.display = 'block';
  
      const formData = new FormData();
      formData.append('image', file);
  
      xhr = new XMLHttpRequest();
      xhr.open('POST', uploadUrl, true);
      xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  
      xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
          const percent = Math.round((e.loaded / e.total) * 100);
          progressBar.style.width = percent + '%';
        }
      });
  
      xhr.onload = function () {
        if (xhr.status === 200) {
          const res = JSON.parse(xhr.responseText);
          if (hiddenInput) hiddenInput.value = res.path;
          if (status) status.innerText = '✅ Image uploaded!';
          if (submitBtn) submitBtn.disabled = false;
        } else {
          if (status) status.innerText = '❌ Upload failed!';
          if (submitBtn) submitBtn.disabled = false;
        }
      };
  
      xhr.onerror = function () {
        if (status) status.innerText = '❌ Error uploading image!';
        if (submitBtn) submitBtn.disabled = false;
      };
  
      xhr.send(formData);
    });
  
    // ✅ Cancel button logic
    cancelBtn.addEventListener('click', function () {
      if (xhr) xhr.abort(); // cancel the request
      previewWrapper.style.display = 'none';
      imageInput.value = '';
      progressBar.style.width = '0%';
      progressContainer.style.display = 'none';
      if (status) status.innerText = 'Upload canceled.';
      if (hiddenInput) hiddenInput.value = '';
      if (submitBtn) submitBtn.disabled = false;
    });
  }

  
  