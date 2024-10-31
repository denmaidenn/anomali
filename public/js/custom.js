document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.loader-wrapper');
    
    // Fungsi untuk menampilkan loader dengan delay
    function showLoader() {
        loader.classList.remove('hidden');
    }

    // Fungsi untuk menyembunyikan loader dengan delay
    function hideLoader() {
        setTimeout(function() {
            loader.classList.add('hidden');
        }, 500);
    }

    // Handle initial page load
    showLoader();
    window.addEventListener('load', hideLoader);

    // Handle AJAX requests
    $(document).ajaxStart(showLoader);
    $(document).ajaxComplete(hideLoader);

    // Handle page navigation
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            hideLoader();
        }
    });

    // Handle clicking links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && !link.hasAttribute('data-no-loader')) {
            showLoader();
        }
    });

    // Handle form submissions
    document.addEventListener('submit', function(e) {
        if (!e.target.hasAttribute('data-no-loader')) {
            showLoader();
        }
    });
});