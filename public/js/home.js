
function animateNumber(element, target, duration) {
    let start = 0;
    const increment = Math.ceil(target / (duration / 10));

    function updateNumber() {
        start += increment;
        if (start >= target) {
            element.textContent = target.toLocaleString() + (element.dataset.suffix || "");
        } else {
            element.textContent = start.toLocaleString() + (element.dataset.suffix || "");
            requestAnimationFrame(updateNumber);
        }
    }

    updateNumber();
}

document.addEventListener("DOMContentLoaded", () => {
    const numbers = document.querySelectorAll(".hero-stats .hero-stat h2");

    numbers.forEach((number) => {
        const originalText = number.textContent;
        const target = parseInt(originalText.replace(/\D/g, ""), 10);
        number.dataset.suffix = originalText.replace(/\d+/g, "");
        number.textContent = "0" + number.dataset.suffix;
        animateNumber(number, target, 2000);
    });

    // Slider logic (đã hợp nhất và tối ưu hóa)
    const slider = document.querySelector(".product-slider");
    const prevButton = document.querySelector(".prev-slide");
    const nextButton = document.querySelector(".next-slide");

    if (prevButton && nextButton) {
        prevButton.addEventListener("click", () => {
            slider.scrollTo({
                left: slider.scrollLeft - 320,
                behavior: "smooth"
            });
        });

        nextButton.addEventListener("click", () => {
            slider.scrollTo({
                left: slider.scrollLeft + 320,
                behavior: "smooth"
            });
        });
    }

    // Kéo chuột để cuộn mượt mà hơn
    let isDragging = false;
    let startX = 0;
    let scrollLeft = 0;

    slider.addEventListener("mousedown", (e) => {
        isDragging = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
        slider.style.scrollBehavior = "auto";
    });

    slider.addEventListener("mouseleave", () => {
        isDragging = false;
        slider.style.scrollBehavior = "smooth";
    });

    slider.addEventListener("mouseup", () => {
        isDragging = false;
        slider.style.scrollBehavior = "smooth";
    });

    slider.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });
});
document.addEventListener("DOMContentLoaded", () => {
// ... (mã animateNumber và slider logic) ...

// Kéo chuột để cuộn mượt mà hơn (các item dính vào chuột)
let isDragging = false;
let startX = 0;
let currentX = 0;

slider.addEventListener("mousedown", (e) => {
    isDragging = true;
    startX = e.pageX - slider.offsetLeft;
    currentX = slider.scrollLeft;
    slider.style.scrollBehavior = "auto";
    slider.style.cursor = "grabbing";
});

slider.addEventListener("mouseleave", () => {
    isDragging = false;
    slider.style.scrollBehavior = "smooth";
    slider.style.cursor = "grab";
});

slider.addEventListener("mouseup", () => {
    isDragging = false;
    slider.style.scrollBehavior = "smooth";
    slider.style.cursor = "grab";
});

slider.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX); // Điều chỉnh tốc độ kéo
    slider.scrollLeft = currentX - walk; // Sử dụng currentX
});

// Thay đổi con trỏ chuột khi hover
slider.style.cursor = "grab";
});
document.addEventListener('DOMContentLoaded', function() {
    const col5 = document.querySelector('.col5');
    const prevArrow = document.querySelector('.product-slider-prev');
    const nextArrow = document.querySelector('.product-slider-next');
    const productWidth = document.querySelector('.product-item').offsetWidth + 20; // Cộng thêm margin

    // Giới hạn phạm vi cuộn của slider trong col5
    const maxScrollLeft = col5.scrollWidth - col5.clientWidth;

    const scrollSmoothly = (targetScrollLeft, duration) => {
        const startScrollLeft = col5.scrollLeft;
        const distance = targetScrollLeft - startScrollLeft;
        let startTime = null;
        let animationFrameId;

        const animateScroll = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const timeElapsed = timestamp - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            col5.scrollLeft = startScrollLeft + distance * progress;

            if (timeElapsed < duration) {
                animationFrameId = requestAnimationFrame(animateScroll);
            }
        };

        animationFrameId = requestAnimationFrame(animateScroll);
    };

    prevArrow.addEventListener('click', () => {
        const targetScrollLeft = Math.max(col5.scrollLeft - productWidth, 0);
        scrollSmoothly(targetScrollLeft, 300); // Điều chỉnh thời gian cuộn (300ms)
    });

    nextArrow.addEventListener('click', () => {
        const targetScrollLeft = Math.min(col5.scrollLeft + productWidth, maxScrollLeft);
        scrollSmoothly(targetScrollLeft, 300); // Điều chỉnh thời gian cuộn (300ms)
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const col5 = document.querySelector('.col50');
    const prevArrow = document.querySelector('.product-slider-prev1');
    const nextArrow = document.querySelector('.product-slider-next1');
    const productWidth = document.querySelector('.product-item.box').offsetWidth + 20; // Cộng thêm margin

    // Giới hạn phạm vi cuộn của slider trong col5
    const maxScrollLeft = col5.scrollWidth - col5.clientWidth;

    const scrollSmoothly = (targetScrollLeft, duration) => {
        const startScrollLeft = col5.scrollLeft;
        const distance = targetScrollLeft - startScrollLeft;
        let startTime = null;
        let animationFrameId;

        const animateScroll = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const timeElapsed = timestamp - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            col5.scrollLeft = startScrollLeft + distance * progress;

            if (timeElapsed < duration) {
                animationFrameId = requestAnimationFrame(animateScroll);
            }
        };

        animationFrameId = requestAnimationFrame(animateScroll);
    };

    prevArrow.addEventListener('click', () => {
        const targetScrollLeft = Math.max(col5.scrollLeft - productWidth, 0);
        scrollSmoothly(targetScrollLeft, 300); // Điều chỉnh thời gian cuộn (300ms)
    });

    nextArrow.addEventListener('click', () => {
        const targetScrollLeft = Math.min(col5.scrollLeft + productWidth, maxScrollLeft);
        scrollSmoothly(targetScrollLeft, 300); // Điều chỉnh thời gian cuộn (300ms)
    });
});
document.querySelectorAll(".product-item button").forEach(button => {
    button.addEventListener("mouseenter", function () {
        this.closest(".product-item").querySelector(".product-image img").style.transform = "scale(1.1)";
    });
    button.addEventListener("mouseleave", function () {
        this.closest(".product-item").querySelector(".product-image img").style.transform = "scale(1)";
    });
});

document.querySelectorAll(".blog-item h3").forEach(title => {
    title.addEventListener("mouseenter", function () {
        this.closest(".blog-item").querySelector("img").style.opacity = "0.7";
        this.closest(".blog-item").querySelector("img").style.transition = "opacity 0.3s ease-in-out";
    });

    title.addEventListener("mouseleave", function () {
        this.closest(".blog-item").querySelector("img").style.opacity = "1";
    });
});
document.querySelectorAll(".blog-item h3, .blog-item img").forEach(element => {
    element.addEventListener("mouseenter", function () {
        let img = this.closest(".blog-item").querySelector("img");
        img.style.opacity = "0.7";
        img.style.transition = "opacity 0.3s ease-in-out";
    });

    element.addEventListener("mouseleave", function () {
        let img = this.closest(".blog-item").querySelector("img");
        img.style.opacity = "1";
    });
});
window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    if (window.scrollY > 50) {
        header.classList.add("shrink");
    } else {
        header.classList.remove("shrink");
    }
});
