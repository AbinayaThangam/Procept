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
            // hide the container when search is empty
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
            window.open(selectedUrl, "_blank");
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
                console.log("Success:", response);
                $("#filter-courses-container").empty();

                if (response.filtercourse && response.filtercourse.length > 0) {
                    let filtercoursetitle = response.filtercourse;
                    filtercoursetitle.forEach(function (course) {
                        let title = course.title;
                        let nid = course.nid;
                        let url = course.url;
                        console.log(title);
                        console.log(nid);
                        console.log(url);
                        $("#filter-courses-container").append(
                            `<li class='list-unstyled course-item' data-nid='${nid}' data-url='${url}' >${title}</li>`
                        );
                    });
                    $("#filter-courses-container").show();
                    $(".course-item").click(function () {
                        let selectedTitle = $(this).text();
                        let selectedNid = $(this).attr("data-nid");
                        let selectedUrl =
                            "/filter/coursedescription/" +
                            $(this).attr("data-nid") +
                            "/" +
                            $(this).attr("data-url");

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
                console.error("Error:", error);
                $("#filter-courses-list").hide();
                $(".filter-courses-container").hide();
            },
        });
    }
});
