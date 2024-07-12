document.addEventListener("DOMContentLoaded", function () {
    // Get all dropdown-toggle elements
    var dropdownToggles = document.querySelectorAll(
        ".dropdown-submenu .dropdown-toggle"
    );

    dropdownToggles.forEach(function (dropdownToggle) {
        dropdownToggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            var submenu = dropdownToggle.nextElementSibling;
            var parentDropdown = dropdownToggle.closest(".dropdown-menu");

            // Close all open submenus
            var openSubmenus = parentDropdown.querySelectorAll(
                ".dropdown-submenu .dropdown-menu.show"
            );
            openSubmenus.forEach(function (openSubmenu) {
                if (openSubmenu !== submenu) {
                    openSubmenu.classList.remove("show");
                }
            });

            // Toggle the submenu
            submenu.classList.toggle("show");
        });
    });

    // Close submenus when clicking outside of the dropdown
    document.addEventListener("click", function (e) {
        var openSubmenus = document.querySelectorAll(".dropdown-submenu .dropdown-menu.show");
        openSubmenus.forEach(function (openSubmenu) {
            if (!openSubmenu.contains(e.target)) {
                openSubmenu.classList.remove("show");
            }
        });
    });
});



$(document).ready(function() {
    var carouselList = $('#carousel ul');
    var slideWidth = carouselList.find('li').outerWidth();
    var interval = 7000; // Interval in milliseconds for auto-slide
    var slideInterval;

    function changeSlide() {
        carouselList.animate({"marginLeft": -slideWidth}, 500, moveFirstSlide);
    }

    function moveFirstSlide() {
        var firstItem = carouselList.find("li:first");
        var lastItem = carouselList.find("li:last");
        lastItem.after(firstItem);
        carouselList.css({"marginLeft": 0});
        updateActiveIndicator();
    }

    function moveSlideLeft() {
        if (carouselList.is(':animated')) {
            return false;
        }
        var firstItem = carouselList.find("li:first");
        var lastItem = carouselList.find("li:last");
        firstItem.before(lastItem);
        carouselList.css({"marginLeft": -slideWidth});
        carouselList.animate({"marginLeft": 0}, 500, updateActiveIndicator);
    }

    function moveSlideRight() {
        if (carouselList.is(':animated')) {
            return false;
        }
        carouselList.animate({"marginLeft": -slideWidth}, 500, moveFirstSlide);
    }

    function updateActiveIndicator() {
        var active = $('.carousel-controls .active');
        var next = active.next();
        if (next.length === 0) {
            next = $('.carousel-controls div').first();
        }
        active.removeClass('active');
        next.addClass('active');
    }

    // Interval for auto-slide
    slideInterval = setInterval(changeSlide, interval);

    // Pause on hover
    $('#carousel').hover(function() {
        clearInterval(slideInterval);
    }, function() {
        slideInterval = setInterval(changeSlide, interval);
    });

    // Button click handlers
    $('.carousel-button-left').on('click', moveSlideLeft);
    $('.carousel-button-right').on('click', moveSlideRight);
});

