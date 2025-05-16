 // Trigger file input when the button is clicked
 function triggerFileInput() {
    const fileInput = document.getElementById('file-input');
    fileInput.click(); // Trigger the file input click
}

// Preview the image once selected
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.createElement('img');
            img.src = reader.result;
            img.alt = 'Image Preview';

            const button = document.getElementById('insert-image-btn');
            button.innerHTML = ''; // Clear any previous content
            button.appendChild(img); // Add the image inside the button
            button.style.backgroundImage = 'none'; // Remove any previous background image
            button.style.backgroundColor = 'transparent'; // Make background transparent
        };
        reader.readAsDataURL(file);
    }
}