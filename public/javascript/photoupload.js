document.getElementById('photo-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const photoPreview = document.getElementById('photo-preview');
    const photoIcon = document.getElementById('photo-icon');
    
    if (file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            alert('Please select an image file (JPEG, PNG, etc.)');
            return;
        }

        // Validate file size (e.g., 2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be less than 2MB');
            return;
        }

        const reader = new FileReader();
        
        reader.onload = function(event) {
            photoPreview.src = event.target.result;
            photoPreview.classList.remove('hidden');
            photoIcon.classList.add('hidden');
        };
        
        reader.onerror = function() {
            console.error('Error reading file');
            alert('Error loading image. Please try another file.');
        };
        
        reader.readAsDataURL(file);
    }
});