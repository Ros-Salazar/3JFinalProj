// Attach smooth scroll functionality to multiple links
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default link behavior

        // Retrieve the target element
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            smoothScrollTo(target, 2000); // Scroll to target over 2000ms (2 seconds)
        }
    });
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

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const navbarBrand = document.querySelector('.navbar-brand');
    const servicesSection = document.querySelector('.services-section');
    const testimonialsSection = document.querySelector('.testimonials-section');
    const heroSection = document.querySelector('#hero-section');
    const originalBrandText = navbarBrand.textContent;
    let currentSection = 'hero';
    let isAnimating = false;

    function updateBrandText(newText) {
        if (isAnimating) return;
        isAnimating = true;

        navbarBrand.classList.add('fade-out');

        setTimeout(() => {
            navbarBrand.textContent = newText;
            navbarBrand.classList.remove('fade-out');
            navbarBrand.classList.add('fade-in');

            setTimeout(() => {
                navbarBrand.classList.remove('fade-in');
                isAnimating = false;
            }, 500);
        }, 500);
    }

    // Intersection Observer for animations
    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.1 // 10% of the section is visible
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Remove existing animate class first to restart animation
                entry.target.classList.remove('animate');
                
                // Trigger reflow to restart animation
                void entry.target.offsetWidth;
                
                // Add animate class
                entry.target.classList.add('animate');

                // Update navbar brand text based on section
                let newSection = 'hero';
                let newText = originalBrandText;

                if (entry.target === servicesSection) {
                    newSection = 'services';
                    newText = 'Our Services';
                    // Trigger carousel animation
                    const carouselContainer = document.querySelector('.carousel-container');
                    carouselContainer.classList.remove('animate');
                    void carouselContainer.offsetWidth; // Trigger reflow
                    carouselContainer.classList.add('animate');
                } else if (entry.target === testimonialsSection) {
                    newSection = 'testimonials';
                    newText = 'Testimonials';
                }

                if (currentSection !== newSection) {
                    updateBrandText(newText);
                    currentSection = newSection;
                }
            }
        });
    }, observerOptions);

    // Observe sections
    sectionObserver.observe(heroSection);
    sectionObserver.observe(servicesSection);
    sectionObserver.observe(testimonialsSection);

    // Existing scroll event for navbar styling
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
