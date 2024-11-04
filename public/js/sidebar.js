document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    const content = document.querySelector('.content-wrapper');

    function toggleSidebar() {
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
      document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
    }

    if (sidebarToggle) {
      sidebarToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleSidebar();
      });
    }

    // Close sidebar when clicking overlay
    overlay.addEventListener('click', toggleSidebar);

    // Handle table scrolling
    const tables = document.querySelectorAll('.table-responsive');
    tables.forEach(table => {
      let isDown = false;
      let startX;
      let scrollLeft;

      table.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - table.offsetLeft;
        scrollLeft = table.scrollLeft;
      });

      table.addEventListener('mouseleave', () => {
        isDown = false;
      });

      table.addEventListener('mouseup', () => {
        isDown = false;
      });

      table.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - table.offsetLeft;
        const walk = (x - startX) * 2;
        table.scrollLeft = scrollLeft - walk;
      });
    });
  });
