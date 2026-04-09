const clearButton = document.getElementById('clearbutton');
const postButton = document.getElementById('submitbutton');

clearButton.addEventListener('click', areYouSure);

function areYouSure(e) {
    const confirmClear = confirm('Are you sure you want to clear? This will reset your blog post.');
    if (!confirmClear) {
        e.preventDefault();
    }
}

postButton.addEventListener('click', validateInput);

function validateInput(e) {
    const titleBox = document.getElementById('title');
    const textArea = document.getElementById('blogpost');
    let hasError = false;

    // Remove any existing error message
    const existingError = document.getElementById('form-error-message');
    if (existingError) {
        existingError.remove();
    }

    if (textArea.value.trim() === '') {
        textArea.style.border = '2px solid red';
        hasError = true;
    } else {
        textArea.style.border = 'none';
    }

    if (titleBox.value.trim() === '') {
        titleBox.style.border = '2px solid red';
        hasError = true;
    } else {
        titleBox.style.border = 'none';
    }

    if (hasError) {
        e.preventDefault();
        // Only append the error message if needed
        const errorMessage = document.createElement('p');
        errorMessage.id = 'form-error-message';
        errorMessage.textContent = 'Please fill in the required fields.';
        textArea.insertAdjacentElement('afterend', errorMessage);
    }
}