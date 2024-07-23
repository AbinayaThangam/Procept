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
        var openSubmenus = document.querySelectorAll(
            ".dropdown-submenu .dropdown-menu.show"
        );
        openSubmenus.forEach(function (openSubmenu) {
            if (!openSubmenu.contains(e.target)) {
                openSubmenu.classList.remove("show");
            }
        });
    });
});

$(document).ready(function () {
    var carouselList = $("#carousel ul");
    var slideWidth = carouselList.find("li").outerWidth();
    var interval = 7000; // Interval in milliseconds for auto-slide
    var slideInterval;

    function changeSlide() {
        carouselList.animate({ marginLeft: -slideWidth }, 500, moveFirstSlide);
    }

    function moveFirstSlide() {
        var firstItem = carouselList.find("li:first");
        var lastItem = carouselList.find("li:last");
        lastItem.after(firstItem);
        carouselList.css({ marginLeft: 0 });
        updateActiveIndicator();
    }

    function moveSlideLeft() {
        if (carouselList.is(":animated")) {
            return false;
        }
        var firstItem = carouselList.find("li:first");
        var lastItem = carouselList.find("li:last");
        firstItem.before(lastItem);
        carouselList.css({ marginLeft: -slideWidth });
        carouselList.animate({ marginLeft: 0 }, 500, updateActiveIndicator);
    }

    function moveSlideRight() {
        if (carouselList.is(":animated")) {
            return false;
        }
        carouselList.animate({ marginLeft: -slideWidth }, 500, moveFirstSlide);
    }

    function updateActiveIndicator() {
        var active = $(".carousel-controls .active");
        var next = active.next();
        if (next.length === 0) {
            next = $(".carousel-controls div").first();
        }
        active.removeClass("active");
        next.addClass("active");
    }

    // Interval for auto-slide
    slideInterval = setInterval(changeSlide, interval);

    // Pause on hover
    $("#carousel").hover(
        function () {
            clearInterval(slideInterval);
        },
        function () {
            slideInterval = setInterval(changeSlide, interval);
        }
    );

    // Button click handlers
    $(".carousel-button-left").on("click", moveSlideLeft);
    $(".carousel-button-right").on("click", moveSlideRight);
});

$(document).ready(function() {
    let slideIndex = 0;
    const interval = 5000; // Change slide every 5 seconds
    const slides = $(".upcoming-testimonial-list li");
    const dotsContainer = $(".dots-container");

    function createDots() {
        slides.each(function(index) {
            let dot = $('<span class="dot"></span>');
            dot.attr('data-index', index);
            dotsContainer.append(dot);
        });
        updateActiveIndicator();
    }

    function showSlides(n) {
        if (n >= slides.length) { slideIndex = 0; }
        if (n < 0) { slideIndex = slides.length - 1; }
        slides.hide();
        const dots = $(".dot");
        dots.removeClass("active");
        slides.eq(slideIndex).show();
        dots.eq(slideIndex).addClass("active");
    }

    function changeSlide() {
        let slideWidth = slides.outerWidth();
        $("#testimonial_carousel ul").animate({ marginLeft: -slideWidth }, 500, function() {
            let firstItem = $("#testimonial_carousel ul li:first");
            $("#testimonial_carousel ul").append(firstItem);
            $("#testimonial_carousel ul").css({ marginLeft: 0 });
        });
        updateActiveIndicator();
    }

    function updateActiveIndicator() {
        let active = $(".dot.active");
        let next = active.next(".dot");
        if (next.length === 0) { next = $(".dot").first(); }
        active.removeClass("active");
        next.addClass("active");
    }

    dotsContainer.on("click", ".dot", function() {
        slideIndex = $(this).data("index");
        showSlides(slideIndex);
    });

    let slideInterval = setInterval(function() {
        slideIndex++;
        showSlides(slideIndex);
    }, interval);

    $("#testimonial_carousel").hover(
        function () { clearInterval(slideInterval); },
        function () { slideInterval = setInterval(function() {
            slideIndex++;
            showSlides(slideIndex);
        }, interval); }
    );

    // Initialize dots
    createDots();
    showSlides(slideIndex);
});
$(document).ready(function() {
    var colors = ['color1', 'color2', 'color3'];
    $('.pmi-pdu-breakdown-content table tr:first-child td').each(function(index) {
        $(this).addClass(colors[index % colors.length]);
    });
});
