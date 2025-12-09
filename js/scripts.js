document.addEventListener('DOMContentLoaded', function() {
    // Example for simple form validation on registration and login
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Function to toggle additional movie information
    document.addEventListener("DOMContentLoaded", () => {
        const infoButtons = document.querySelectorAll('.toggle-movie-info');
    
        infoButtons.forEach(button => {
            button.addEventListener('click', function () {
                const movieInfo = this.nextElementSibling;
                if (movieInfo) {
                    movieInfo.classList.toggle('visible');
                }
            });
        });
    });
});
