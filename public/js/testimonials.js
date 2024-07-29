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

$(document).ready(function () {
    let slideIndex = 0;
    const interval = 5000; // Change slide every 5 seconds
    const slides = $(".upcoming-testimonial-list li");
    const dotsContainer = $(".dots-container");
    const carouselContainer = $("#testimonial_carousel");

    const numDots = slides.length; // Corrected from list.find('li').length to slides.length

    function createDots() {
        // Remove existing dots
        dotsContainer.empty();
        if (slides.length > 0) {
            for (let i = 0; i < numDots; i++) {
                let dot = $('<span class="dot"></span>');
                dot.attr("data-index", i);
                dotsContainer.append(dot);
            }
            updateActiveIndicator();
            dotsContainer.show(); // Show dots if slides are available
        } else {
            dotsContainer.hide(); // Hide dots if no slides are available
            clearInterval(slideInterval); // Stop carousel rotation
        }
    }

    function showSlides(n) {
        // Ensure slideIndex is within range
        if (slides.length === 0) return; // No slides to show
        if (n >= slides.length) {
            slideIndex = 0;
        }
        if (n < 0) {
            slideIndex = slides.length - 1;
        }
        slides.hide();
        const dots = $(".dot");
        dots.removeClass("active");
        if (slides.length > 0) {
            slides.eq(slideIndex % slides.length).show();
            dots.eq(slideIndex % numDots).addClass("active");
        }
    }

    function changeSlide() {
        slideIndex++;
        showSlides(slideIndex);
    }

    function updateActiveIndicator() {
        let active = $(".dot.active");
        let next = active.next(".dot");
        if (next.length === 0) {
            next = $(".dot").first();
        }
        active.removeClass("active");
        next.addClass("active");
    }

    dotsContainer.on("click", ".dot", function () {
        slideIndex = $(this).data("index");
        showSlides(slideIndex);
    });

    let slideInterval = setInterval(changeSlide, interval);

    $("#testimonial_carousel").hover(
        function () {
            clearInterval(slideInterval);
        },
        function () {
            slideInterval = setInterval(changeSlide, interval);
        }
    );

    function initializeCarousel() {
        if (slides.length > 0) {
            createDots();
            showSlides(slideIndex);
            carouselContainer.show(); // Show carousel if slides are available
        } else {
            carouselContainer.hide(); // Hide carousel if no slides are available
        }
    }

    // Initialize the carousel
    initializeCarousel();
});

$(document).ready(function () {
    var colors = ["color1", "color2", "color3"];
    $(".pmi-pdu-breakdown-content table tr:first-child td").each(function (
        index
    ) {
        $(this).addClass(colors[index % colors.length]);
    });
});
// video testimonial
$(document).ready(function() {
    const scrollInterval = 5000; // Time between scrolls (in milliseconds)
    const scrollDuration = 500; // Duration of scroll animation (in milliseconds)
    const list = $(".video-testimonial-list");
    const dotsContainer = $(".carousel-dots-container"); // Updated class name
    const numDots =  list.find('li').length;;
    let listItemHeight = list.find('li').first().outerHeight();
    let totalHeight = listItemHeight * list.find('li').length;
    let currentScroll = 0;

    // Create dots
    function createDots() {
        dotsContainer.empty();
        for (let i = 0; i < numDots; i++) {
            let dot = $('<span class="carousel-dot"></span>'); // Updated class name
            dot.attr('data-index', i);
            dotsContainer.append(dot);
        }
        updateActiveDot();
    }

    // Update active dot based on scroll position
    function updateActiveDot() {
        const dots = $(".carousel-dot"); // Updated class name
        dots.removeClass("active");
        const activeIndex = Math.floor(currentScroll / listItemHeight) % numDots;
        dots.eq(activeIndex).addClass("active");
    }

    // Auto-scroll functionality
    function autoScroll() {
        if (totalHeight <= list.height()) {
            // If total height of list items is less than container height, no need to scroll
            return;
        }

        list.animate({
            scrollTop: currentScroll + listItemHeight
        }, scrollDuration, function() {
            currentScroll += listItemHeight;

            if (currentScroll >= totalHeight) {
                currentScroll = 0; // Reset to top
                list.scrollTop(0); // Reset scroll position
            }
            updateActiveDot();
            playCurrentVideo(); // Autoplay the video
        });
    }

    // Autoplay the video in the current list item
    function playCurrentVideo() {
        const currentVideo = list.find('li').eq(currentScroll / listItemHeight).find('video')[0];
        if (currentVideo) {
            currentVideo.play();
        }
    }

    // Dot click event
    dotsContainer.on('click', '.carousel-dot', function() {
        const index = $(this).data('index');
        currentScroll = index * listItemHeight;
        list.animate({
            scrollTop: currentScroll
        }, scrollDuration, function() {
            updateActiveDot();
            playCurrentVideo(); // Autoplay the video
        });
    });

    // Initialize
    createDots();
    setInterval(autoScroll, scrollInterval);
});

$(document).ready(function () {
    $(".page-search-courses").keyup(function (event) {
        let searchValue = $(this).val().trim();

        if (searchValue !== "") {
            $(".filter-page-courses-container").show();
            getSearchCoursesDetails(searchValue);
        } else {
            $("#filter-page-courses-container").empty();
            $("#selected-nid").val("");
            $("#course-summary").attr("href", "").text("");
            $(".filter-page-courses-container").hide();

        }

        if (event.keyCode === 13) {
            performPageSearch();
        }
    });

    $(".training-search-icon.page-search-courses").click(function () {

        performPageSearch();
    });

    function performPageSearch() {
        let searchValue = $(".page-search-courses").val().trim();
        let selectedNid = $("#selected-nid").val();
        let selectedNodeType = $("#selected-node-type").val();
        let selectedUrl = $("#course-summary").attr("href");

        if (selectedNid && selectedUrl && selectedNodeType === 'course') {

            const selectedUrlCourses ='/courses/'+selectedUrl ;
            window.open(selectedUrlCourses, "_blank");

        } else if (selectedNid && selectedUrl && selectedNodeType === 'article') {

            const selectedUrlArticle ='/article/'+selectedUrl ;

            window.open(selectedUrlArticle, "_blank");

        } else if (selectedNid && selectedUrl && selectedNodeType === 'events') {

            const selectedUrlEvents ='/events/'+selectedUrl ;

            window.open(selectedUrlEvents, "_blank");

       } else if (selectedNid && selectedUrl && selectedNodeType === 'page') {

        const selectedUrlEvents ='/page/'+selectedUrl ;

        window.open(selectedUrlEvents, "_blank");

      } else if (selectedNid && selectedUrl && selectedNodeType === 'team') {

        const selectedUrlTeam ='/team/'+selectedUrl ;

        window.open(selectedUrlTeam, "_blank");

       }  else if (searchValue !== "") {

            getSearchCoursesDetails(searchValue);

        } else {
            // Handle clearing of the search box
            handleSearchBoxClear();
        }
    }

    function handleSearchBoxClear() {
        $(".page-search-courses").val("");
        $("#filter-page-courses-container").empty();
        $(".filter-page-courses-container").hide();

        $("#course-summary").attr("href", "").text("");
        $("#selected-nid").val("");
        $("#selected-node-type").val("");
    }

    function getSearchCoursesDetails(title) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/filter/coursepagetitle",
            method: "GET",
            data: {
                title: title,
            },
            success: function (response) {


                $("#filter-page-courses-container").empty();

                if (response.filterPageCourse && response.filterPageCourse.length > 0) {
                    let filtercoursepagetitle = response.filterPageCourse;
                    filtercoursepagetitle.forEach(function (course) {
                        let title = course.title;
                        let nid = course.nid;
                        let node_type = course.type;
                        let url = course.url;
                        console.log(node_type);

                        $("#filter-page-courses-container").append(
                            `<li class='list-unstyled course-item' data-nid='${nid}' data-node-type='${node_type}' data-url='${url}' >${title}</li>`
                        );
                    });

                    $("#filter-page-courses-container").show();
                    $(".course-item").click(function () {
                        let selectedTitle = $(this).text();
                        let selectedNid = $(this).attr("data-nid");
                        let selectedUrl = $(this).attr("data-url");
                        let selectedNodeType = $(this).attr("data-node-type");

                        $(".page-search-courses").val(selectedTitle);

                        $("#course-summary")
                            .attr("href", selectedUrl)
                            .text(selectedTitle);

                        $("#selected-nid").val(selectedNid);
                        $("#selected-node-type").val(selectedNodeType);
                        $(".filter-page-courses-container").hide();

                        //handleSearchBoxClear();
                    });
                } else {
                    console.error(
                        "Error: Unable to fetch course title or no results found."
                    );
                    $("#filter-page-courses-container")
                        .empty()
                        .append(
                            "<li class='no-results list-unstyled'>No results found</li>"
                        );
                    $("#filter-page-courses-container").show();
                    // $("#filter-courses-container").hide();
                    // $(".filter-courses-container").hide();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                $("#filter-courses-list").hide();
                $(".filter-courses-container").hide();
            },
        });
    }
    if (localStorage.getItem("lastSection")) {
        var lastSection = localStorage.getItem("lastSection");
        if ($(lastSection).length) {
            $("html, body").animate(
                {
                    scrollTop: $(lastSection).offset().top,
                },
                1000
            );
            // Clear the saved section ID from localStorage
            localStorage.removeItem("lastSection");
        }
    }

    // Save the section ID to localStorage when a link is clicked
    $("a").on("click", function (event) {
        var sectionId = $(this).attr("href");
        if (sectionId && sectionId.startsWith("#") && $(sectionId).length) {
            localStorage.setItem("lastSection", sectionId);
            event.preventDefault(); // Prevent the default link behavior
            $("html, body").animate(
                {
                    scrollTop: $(sectionId).offset().top,
                },
                1000
            );
        }
    });
});

