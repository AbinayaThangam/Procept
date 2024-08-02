$(document).ready(function () {
    $(".search-courses").keyup(function (event) {
        let searchValue = $(this).val().trim();

        if (searchValue !== "") {
            $(".filter-courses-container").show();
            getSearchCoursesDetails(searchValue);
        } else {
            $("#filter-courses-container").empty();
            $("#selected-nid").val("");
            $("#course-summary").attr("href", "").text("");
            $(".filter-courses-container").hide();

        }

        if (event.keyCode === 13) {
            performSearch();
        }
    });

    $("img.search-icon").click(function () {

        performSearch();
    });

    function performSearch() {
        let searchValue = $(".search-courses").val().trim();
        let selectedNid = $("#selected-nid").val();
        let selectedUrl = $("#course-summary").attr("href");
        if (selectedNid && selectedUrl) {
            const selectedUrlCourses ='/courses/'+selectedUrl ;
            window.open(selectedUrlCourses, "_blank");
        } else if (searchValue !== "") {
            getSearchCoursesDetails(searchValue);
        } else {
            handleSearchBoxClear();
        }
    }

    function handleSearchBoxClear() {
        $(".search-courses").val("");
        $("#filter-courses-container").empty();
        $(".filter-courses-container").hide();

        $("#course-summary").attr("href", "").text("");
        $("#selected-nid").val("");
    }

    function getSearchCoursesDetails(title) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/filter/coursetitle",
            method: "GET",
            data: {
                title: title,
            },
            success: function (response) {
                $("#filter-courses-container").empty();

                if (response.filtercourse && response.filtercourse.length > 0) {
                    let filtercoursetitle = response.filtercourse;
                    filtercoursetitle.forEach(function (course) {
                        let title = course.title;
                        let nid = course.nid;
                        let url = course.url;
                        $("#filter-courses-container").append(
                            `<li class='list-unstyled course-item' data-nid='${nid}' data-url='${url}' >${title}</li>`
                        );
                    });
                    $("#filter-courses-container").show();
                    $(".course-item").click(function () {
                        let selectedTitle = $(this).text();
                        let selectedNid = $(this).attr("data-nid");
                        let selectedUrl = $(this).attr("data-url");

                        $(".search-courses").val(selectedTitle);

                        $("#course-summary")
                            .attr("href", selectedUrl)
                            .text(selectedTitle);

                        $("#selected-nid").val(selectedNid);
                        $(".filter-courses-container").hide();

                        //handleSearchBoxClear();
                    });
                } else {
                    console.error(
                        "Error: Unable to fetch course title or no results found."
                    );
                    $("#filter-courses-container")
                        .empty()
                        .append(
                            "<li class='no-results list-unstyled'>No results found</li>"
                        );
                    $("#filter-courses-container").show();
                    // $("#filter-courses-container").hide();
                    // $(".filter-courses-container").hide();
                }
            },
            error: function (xhr, status, error) {
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

// video testimonials

document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("video-container");
    if (!container) {
        console.error("Element with ID 'video-container' not found.");
        return; // Exit early to prevent further errors
    }
    const wrappers = container.querySelectorAll(".video-wrapper");
    const dotsContainer = document.getElementById("dots-container");
    let currentIndex = 0;

    function showVideo(index) {
        // Hide all videos
        wrappers.forEach((wrapper) => (wrapper.style.display = "none"));
        // Remove active class from all dots
        dotsContainer
            .querySelectorAll(".dot")
            .forEach((dot) => dot.classList.remove("active"));

        // Show the current video
        wrappers[index].style.display = "block";
        // Add active class to the current dot
        dotsContainer.children[index].classList.add("active");
    }

    function nextVideo() {
        currentIndex = (currentIndex + 1) % wrappers.length;
        showVideo(currentIndex);
    }

    function createDots() {
        dotsContainer.innerHTML = ""; // Clear existing dots if any
        wrappers.forEach((_, index) => {
            const dot = document.createElement("div");
            dot.classList.add("dot");
            dot.addEventListener("click", () => {
                currentIndex = index;
                showVideo(currentIndex);
            });
            dotsContainer.appendChild(dot);
        });
    }

    // Initialize with the first video and dots
    if (wrappers.length > 0) {
        createDots();
        showVideo(currentIndex);
        // Auto-switch videos every 5 seconds
        // setInterval(nextVideo, 5000);
    }
});

$(document).ready(function() {
    $('#read-more-btn').on('click', function() {
        var $snippet = $('#body-snippet');
        var $fullBody = $('#full-body');
        var $btn = $(this);

        if ($fullBody.is(':hidden')) {
            $fullBody.show();
            $snippet.hide();
            $btn.text('Read Less');
        } else {
            $fullBody.hide();
            $snippet.show();
            $btn.text('Read More');
        }
    });
});
