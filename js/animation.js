// Smooth scroll for "Services"
document.getElementById('smooth-services').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default link behavior
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
        smoothScrollTo(target, 2000); // Scroll to target over 2000ms (2 seconds)
    }
});

// Smooth scroll for "Home"
document.getElementById('home-services').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default link behavior
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
        smoothScrollTo(target, 2000); // Scroll to target over 2000ms (2 seconds)
    }
});

// Smooth scroll function
function smoothScrollTo(element, duration) {
    const targetPosition = element.getBoundingClientRect().top + window.pageYOffset;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;

    function animationScroll(currentTime) {
        if (startTime === null) startTime = currentTime;
        const elapsedTime = currentTime - startTime;
        const run = easeInOutQuad(elapsedTime, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (elapsedTime < duration) {
            requestAnimationFrame(animationScroll);
        }
    }

    function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animationScroll);
}
