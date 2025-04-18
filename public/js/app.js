
const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('added') === 'true') {
    const alertBox = document.getElementById('alert');
    alertBox.style.display = 'block';
    setTimeout(() => {
      alertBox.style.display = 'none';
    }, 4000); // 4 seconds
  }



