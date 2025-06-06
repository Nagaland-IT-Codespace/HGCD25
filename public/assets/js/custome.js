document.addEventListener("DOMContentLoaded", function() {
    // Toggle desktop dropdown
    const aboutToggle = document.getElementById("aboutToggle");
    const aboutDropdown = document.getElementById("aboutDropdown");

    aboutToggle.addEventListener("click", function(event) {
        aboutDropdown.classList.toggle("hidden");
        event.stopPropagation();
    });

    document.addEventListener("click", function(event) {
        if (!aboutToggle.contains(event.target) && !aboutDropdown.contains(event.target)) {
            aboutDropdown.classList.add("hidden");
        }
    });

    // Toggle mobile menu
    const mobileToggle = document.getElementById("mobileToggle");
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileIcon = mobileToggle.querySelector("i");

    mobileToggle.addEventListener("click", function() {
        mobileMenu.classList.toggle("hidden");
        mobileIcon.classList.toggle("bi-list");
        mobileIcon.classList.toggle("bi-x-lg");
    });

    // Toggle mobile About dropdown
    const mobileAboutToggle = document.getElementById("mobileAboutToggle");
    const mobileAboutDropdown = document.getElementById("mobileAboutDropdown");

    mobileAboutToggle.addEventListener("click", function() {
        mobileAboutDropdown.classList.toggle("hidden");
    });

    // Close mobile menu on outside click
    document.addEventListener("click", function(event) {
        if (!mobileToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add("hidden");
            mobileIcon.classList.add("bi-list");
            mobileIcon.classList.remove("bi-x-lg");
        }
    });

    // Keyboard support: Close dropdowns on Escape key
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            aboutDropdown.classList.add("hidden");
            mobileMenu.classList.add("hidden");
            mobileAboutDropdown.classList.add("hidden");
            mobileIcon.classList.add("bi-list");
            mobileIcon.classList.remove("bi-x-lg");
        }
    });

    // topbar script
    const toggleButton = document.getElementById('accessibilityToggle');
    const dropdown = document.getElementById('accessibilityDropdown');
    let fontSize = 100;

    // Toggle dropdown
    toggleButton.addEventListener('click', function(event) {
        dropdown.classList.toggle('hidden');
        event.stopPropagation();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!toggleButton.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Keyboard accessibility: Close on Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            dropdown.classList.add('hidden');
        }
    });

    // Adjust font size
    window.changeFontSize = function(adjustment) {
        fontSize = Math.min(Math.max(fontSize + adjustment, 80), 150);
        document.documentElement.style.fontSize = fontSize + '%';
    };

    // Reset font size
    window.resetFont = function() {
        fontSize = 100;
        document.documentElement.style.fontSize = '100%';
        document.body.classList.remove('invert');
    };

    // Toggle high contrast mode
    window.toggleContrast = function() {
        document.body.classList.toggle('invert');
    };
});