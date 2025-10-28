<script>
  // Check if mobile view
  function isMobileView() {
    return window.innerWidth < 768; // Tailwind md breakpoint
  }

  // Toggle sidebar function
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarLogo = document.getElementById('sidebar-logo');
    const sonlyLogo = document.getElementById('sonly');

    if (isMobileView()) {
      sidebar.classList.toggle('translate-x-0');
      sidebar.classList.toggle('-translate-x-full');
    } else {
      const isExpanded = sidebar.classList.toggle('w-64');
      sidebar.classList.toggle('w-25', !isExpanded);
      localStorage.setItem('sidebarCollapsed', !isExpanded);

      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.toggle('hidden', !isExpanded);
      });

      sidebarLogo.classList.toggle('hidden', !isExpanded);
      sonlyLogo.classList.toggle('hidden', isExpanded);
    }

    updateDropdownIndicators();
  }

  // ---------------- Dropdown Logic ----------------

  // Setup dropdown behavior (accordion + memory)
  function initDropdownBehavior() {
    const checkboxes = document.querySelectorAll('.collapse input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function () {

        if (this.checked) {
          closeOtherDropdowns(this);
          saveDropdownState(this.id); // Save if open
        } else {
          localStorage.removeItem('activeDropdown'); // Allow close ✅
        }

        updateDropdownIndicators();
      });
    });
  }

  // Close other dropdowns
  function closeOtherDropdowns(activeCheck) {
    document.querySelectorAll('.collapse input[type="checkbox"]').forEach(cb => {
      if (cb !== activeCheck) cb.checked = false;
    });
  }

  // Save active dropdown
  function saveDropdownState(id) {
    localStorage.setItem('activeDropdown', id);
  }

  // Load saved dropdown after refresh
  function applySavedDropdown() {
    const savedId = localStorage.getItem('activeDropdown');
    if (!savedId) return;
    const savedCheck = document.getElementById(savedId);
    if (savedCheck) savedCheck.checked = true;
  }

  // Update icon rotation & style dynamically
  function updateDropdownIndicators() {
    const sidebar = document.getElementById('sidebar');
    const isCollapsed = sidebar.classList.contains('w-25') && !isMobileView();
    const dropdownIcons = document.querySelectorAll('.dropdown-icon');

    dropdownIcons.forEach(icon => {
      const checkbox = icon.closest('.collapse').querySelector('input[type="checkbox"]');
      const isOpen = checkbox.checked;

      icon.style.transition = "transform 0.25s ease";
      icon.style.transform = isOpen ? "rotate(90deg)" : "rotate(0deg)";

      icon.className = 'dropdown-icon fa-solid';
      icon.classList.add(isCollapsed ? (isOpen ? 'fa-minus' : 'fa-plus')
        : (isOpen ? 'fa-chevron-down' : 'fa-chevron-right'));
    });
  }

  // ---------------- Window Resize ----------------
  function handleResize() {
    const sidebar = document.getElementById('sidebar');
    const sidebarLogo = document.getElementById('sidebar-logo');
    const sonlyLogo = document.getElementById('sonly');

    if (isMobileView()) {
      sidebar.classList.add('-translate-x-full');
      sidebar.classList.remove('translate-x-0');
      sidebarLogo.classList.remove('hidden');
      sonlyLogo.classList.add('hidden');
    } else {
      const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
      sidebar.classList.toggle('w-25', isCollapsed);
      sidebar.classList.toggle('w-64', !isCollapsed);

      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.toggle('hidden', isCollapsed);
      });

      sidebarLogo.classList.toggle('hidden', isCollapsed);
      sonlyLogo.classList.toggle('hidden', !isCollapsed);
    }

    updateDropdownIndicators();
  }

  // ---------------- Initialization ----------------
  function initSidebar() {
    const sidebar = document.getElementById('sidebar');

    if (isMobileView()) {
      sidebar.classList.add('-translate-x-full');
    } else {
      const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
      sidebar.classList.add(isCollapsed ? 'w-25' : 'w-64');
    }

    setTimeout(() => sidebar.classList.add('loaded'), 50);

    initDropdownBehavior();
    applySavedDropdown();
    updateDropdownIndicators();
    window.addEventListener('resize', handleResize);
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
    const timeElement = document.getElementById('philippineTime');
    if (timeElement) {
      timeElement.textContent = new Date().toLocaleString('en-PH', options);
    }
  }

  setInterval(displayPhilippineTime, 1000);

  document.addEventListener('DOMContentLoaded', () => {
    displayPhilippineTime();
    initSidebar();
  });
</script>