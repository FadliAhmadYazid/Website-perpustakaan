document.querySelector('.file-input').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profile-img').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});