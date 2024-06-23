document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('loader');

    // Function to show loader
    function showLoader() {
        loader.classList.remove('d-none');
    }

    // Function to hide loader
    function hideLoader() {
        loader.classList.add('d-none');
    }

    // Show loader on link click
    document.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Check if link is for a different page
            if (link.href && link.href !== window.location.href) {
                showLoader();
            }
        });
    });

    // Show loader on form submit
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            showLoader();
        });
    });

    // Hide loader after all content is loaded
    window.addEventListener('load', function() {
        hideLoader();
    });

    // Hide loader when navigating with Turbolinks (if used)
    document.addEventListener('turbolinks:before-visit', function() {
        showLoader();
    });

    document.addEventListener('turbolinks:load', function() {
        hideLoader();
    });

    // Show loader on AJAX start
    $(document).ajaxStart(function() {
        showLoader();
    });

    // Hide loader on AJAX complete
    $(document).ajaxComplete(function() {
        hideLoader();
    });
});
