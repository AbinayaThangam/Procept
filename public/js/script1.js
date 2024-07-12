window.jQuery;
document.addEventListener("DOMContentLoaded", function () {
    const promoList = [
        '<a href="#">Limited time offer</a>',
        '<a href="#">Special announcement 1</a>',
        '<a href="#">Special announcement 2</a>',
    ];

    const videoList = [
        "img/video1.mp4",
        "path/to/video2.mp4",
        "path/to/video3.mp4",
    ];

    function displayRandomPromo() {
        if (promoList.length > 0) {
            const randomIndex = Math.floor(Math.random() * promoList.length);
            const selectedPromo = promoList[randomIndex];
            const promoContainer = document.getElementById("promo-container");
            const promoText = document.getElementById("promo-text");
            promoText.innerHTML = selectedPromo;
            promoContainer.style.display = "block";
        }
    }

    function displayRandomVideo() {
        if (videoList.length > 0) {
            const randomIndex = Math.floor(Math.random() * videoList.length);
            const selectedVideo = videoList[randomIndex];
            const videoElement = document.getElementById("background-video");
            videoElement.src = selectedVideo;
        }
    }

    displayRandomPromo();
    displayRandomVideo();
});

const dropdowns = document.querySelectorAll(".dropdown");

dropdowns.forEach((dropdown) => {
    const select = dropdown.querySelector(".select");
    const caret = dropdown.querySelector(".caret");
    const menu = dropdown.querySelector(".menu");
    const options = dropdown.querySelectorAll(".menu li");
    const selected = dropdown.querySelector(".selected");

    select.addEventListener("click", () => {
        select.classList.toggle("select-clicked");
        caret.classList.toggle("caret-rotate");
        menu.classList.toggle("menu-open");
    });

    options.forEach((option) => {
        option.addEventListener("click", () => {
            selected.innerText = option.innerText;
            select.classList.remove("select-clicked");
            caret.classList.remove("caret-rotate");
            menu.classList.remove("menu-open");
            options.forEach((opt) => opt.classList.remove("active"));
            option.classList.add("active");
        });
    });
// view all event
    // const viewAllBtn = document.getElementById("viewAllBtn");
    // const allEventsList = document.getElementById("allEvents");

    // viewAllBtn.addEventListener("click", function (e) {
    //     e.preventDefault();

    //     allEventsList.classList.toggle("hidden");

    //     if (!allEventsList.classList.contains("hidden")) {
    //         showPopup();
    //     } else {
    //         hidePopup();
    //     }
    // });

    // function showPopup() {
    //     const popup = document.createElement("div");
    //     popup.className = "popup";
    //     popup.innerHTML = `<h2>All Events</h2>
    //               <div class="event-item">
    //             <div class="event-image">
    //                 <img src="img/event1.jpg" alt="Event Image">
    //             </div>
    //             <div class="event-details">
    //                 <h3><a href="#">{!!$event->title</a></h3>
    //                 <p>Date: December 5, 2024</p>
    //             </div>
    //         </div>` + allEventsList.innerHTML;
    //     document.body.appendChild(popup);
    //     popup.style.display = "block";
    // }

  
    // function hidePopup() {
    //     const popup = document.querySelector(".popup");
    //     if (popup) {
    //         popup.style.display = "none";
    //         document.body.removeChild(popup);
    //     }
    // }
// testimonials
        const testimonials = document.querySelectorAll('.testimonial');
        let index = 0;
    
        function rotateTestimonials() {
            testimonials.forEach(testimonial => {
                testimonial.classList.remove('show');
            });
    
            testimonials[index].classList.add('show');
            index = (index + 1) % testimonials.length;
        }
    
        rotateTestimonials(); 
    
     
        setInterval(rotateTestimonials, 10000); 
    });
    
