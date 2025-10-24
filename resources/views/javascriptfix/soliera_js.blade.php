<script>
  // Check if mobile view
  function isMobileView() {
    return window.innerWidth < 768; // Tailwind's md breakpoint
  }

  // Toggle sidebar function
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarLogo = document.getElementById('sidebar-logo');
    const sonlyLogo = document.getElementById('sonly');


    if (isMobileView()) {
      // Mobile behavior - toggle visibility
      if (sidebar.classList.contains('translate-x-0')) {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
      } else {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
      }
    } else {
      // Desktop behavior - toggle between expanded/collapsed
      const isCollapsed = sidebar.classList.toggle('w-64');
      sidebar.classList.toggle('w-25', !isCollapsed);
      localStorage.setItem('sidebarCollapsed', !isCollapsed);

      // Update text visibility based on collapsed state
      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.toggle('hidden', !isCollapsed);
      });

      // Toggle logos based on collapsed state
      if (sidebar.classList.contains('w-25')) {
        sidebarLogo.classList.add('hidden');
        sonlyLogo.classList.remove('hidden');
      } else {
        sidebarLogo.classList.remove('hidden');
        sonlyLogo.classList.add('hidden');
      }
    }

    // Update dropdown indicators
    updateDropdownIndicators();
  }

  // Update dropdown indicators (Font Awesome version)
  function updateDropdownIndicators() {
    const sidebar = document.getElementById('sidebar');
    const isCollapsed = sidebar.classList.contains('w-25') && !isMobileView();
    const dropdownIcons = document.querySelectorAll('.dropdown-icon');

    dropdownIcons.forEach(icon => {
      const isOpen = icon.closest('.collapse').querySelector('input[type="checkbox"]').checked;
      // Reset previous classes
      icon.className = 'dropdown-icon fa-solid';
      // Apply Font Awesome icons depending on state
      if (isCollapsed) {
        icon.classList.add(isOpen ? 'fa-minus' : 'fa-plus');
      } else {
        icon.classList.add(isOpen ? 'fa-chevron-down' : 'fa-chevron-right');
      }
    });
  }

  // Handle window resize
  function handleResize() {
    const sidebar = document.getElementById('sidebar');
    const sidebarLogo = document.getElementById('sidebar-logo');
    const sonlyLogo = document.getElementById('sonly');

    if (isMobileView()) {
      if (!sidebar.classList.contains('translate-x-0')) {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
      }
      sidebarLogo.classList.remove('hidden');
      sonlyLogo.classList.add('hidden');
    } else {
      const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
      sidebar.classList.remove('-translate-x-full', 'translate-x-0');
      sidebar.classList.toggle('w-64', !isCollapsed);
      sidebar.classList.toggle('w-25', isCollapsed);

      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.toggle('hidden', isCollapsed);
      });

      if (isCollapsed) {
        sidebarLogo.classList.add('hidden');
        sonlyLogo.classList.remove('hidden');
      } else {
        sidebarLogo.classList.remove('hidden');
        sonlyLogo.classList.add('hidden');
      }
    }

    updateDropdownIndicators();
  }

  // Initialize sidebar
  function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarLogo = document.getElementById('sidebar-logo');
    const sonlyLogo = document.getElementById('sonly');

    if (isMobileView()) {
      sidebar.classList.add('-translate-x-full');
      sidebarLogo.classList.remove('hidden');
      sonlyLogo.classList.add('hidden');
    } else {
      const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
      sidebar.classList.add(isCollapsed ? 'w-25' : 'w-64');

      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.toggle('hidden', isCollapsed);
      });

      if (isCollapsed) {
        sidebarLogo.classList.add('hidden');
        sonlyLogo.classList.remove('hidden');
      } else {
        sidebarLogo.classList.remove('hidden');
        sonlyLogo.classList.add('hidden');
      }
    }

    setTimeout(() => sidebar.classList.add('loaded'), 50);

    document.querySelectorAll('.collapse input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', updateDropdownIndicators);
    });

    window.addEventListener('resize', handleResize);
    updateDropdownIndicators();
  }

  // Philippine Time
  function displayPhilippineTime() {
    const options = {
      timeZone: 'Asia/Manila',
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: true
    };

    const philippineDateTime = new Date().toLocaleString('en-PH', options);
    const timeElement = document.getElementById('philippineTime');
    if (timeElement) {
      timeElement.textContent = philippineDateTime;
    }
  }

  // Initial call and interval
  displayPhilippineTime();
  setInterval(displayPhilippineTime, 1000);

  // Initialize when DOM loads
  document.addEventListener('DOMContentLoaded', () => {
    displayPhilippineTime();
    initSidebar();
  });
</script>