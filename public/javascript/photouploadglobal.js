
document.getElementById('dropzone-file').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            return;
        }

        const reader = new FileReader(); // Read file as URL
        reader.onload = function(e) {
            document.getElementById('photo').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});


document.getElementById('editdropzone-file').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            return;
        }

        const reader = new FileReader(); // Read file as URL
        reader.onload = function(e) {
            document.getElementById('editphoto').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
