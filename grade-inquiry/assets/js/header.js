
document.addEventListener("DOMContentLoaded", function () {
    const dateElement = document.getElementById("live-date");
    const options = {
        weekday: 'long',
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    };
    dateElement.innerText = new Date().toLocaleDateString('en-US', options);
});

document.addEventListener("DOMContentLoaded", function () {
    // Dropdown Toggle for Mobile
    document.querySelectorAll('.dropdown-toggle').forEach(item => {
        item.addEventListener('click', function (e) {
            if (window.innerWidth < 992) {
                e.preventDefault();

                let parent = this.parentElement;
                let menu = parent.querySelector('.dropdown-menu');

                // Close all dropdowns first
                document.querySelectorAll('.nav-item.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                    let dropdownMenu = dropdown.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        dropdownMenu.classList.remove('show');
                    }
                });

                // Toggle current dropdown
                parent.classList.toggle('show');
                if (menu) {
                    menu.classList.toggle('show');
                }
            }
        });
    });

    // Hover Dropdown for Desktop
    if (window.innerWidth >= 992) {
        document.querySelectorAll('.nav-item.dropdown').forEach(item => {
            item.addEventListener('mouseenter', function () {
                this.classList.add('show');
                this.querySelector('.dropdown-menu').classList.add('show');
            });
            item.addEventListener('mouseleave', function () {
                this.classList.remove('show');
                this.querySelector('.dropdown-menu').classList.remove('show');
            });
        });
    }

    // Close Dropdowns When Clicking Outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.navbar')) {
            document.querySelectorAll('.nav-item.dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
                dropdown.querySelector('.dropdown-menu').classList.remove('show');
            });
        }
    });

    // Navbar Collapse Close on Click (Mobile)
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                let navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                }
            }
        });
    });

    // Reset Dropdowns on Window Resize
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.nav-item.dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
                dropdown.querySelector('.dropdown-menu').classList.remove('show');
            });
        }
    });
}); 
