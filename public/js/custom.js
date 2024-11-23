document.addEventListener('DOMContentLoaded', function () {
    const loader = document.querySelector('.loader-wrapper');

    // Helper function to toggle loader visibility
    const toggleLoader = (show = true) => {
        loader.classList.toggle('hidden', !show);
    };

    // Display the loader when the page starts loading
    toggleLoader(true);

    // Hide the loader when the page fully loads
    window.addEventListener('load', () => toggleLoader(false));

    // Automatically handle AJAX requests
    $(document).on({
        ajaxStart: () => toggleLoader(true),
        ajaxComplete: () => toggleLoader(false),
    });

    // Handle navigation events, including "back" and "forward"
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) toggleLoader(false);
    });

    // Handle clicks on links


    // Handle form submissions
    document.body.addEventListener('submit', (event) => {
        const form = event.target;
        if (!form.hasAttribute('data-no-loader')) {
            toggleLoader(true);
        }
    });
});
