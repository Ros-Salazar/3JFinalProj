document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const navbarBrand = document.querySelector('.navbar-brand');
    const servicesSection = document.querySelector('.services-section');
    const testimonialsSection = document.querySelector('.testimonials-section');
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
    
    window.addEventListener('scroll', function() {
        const servicesSectionTop = servicesSection.getBoundingClientRect().top;
        const servicesSectionBottom = servicesSection.getBoundingClientRect().bottom;
        const testimonialsSectionTop = testimonialsSection.getBoundingClientRect().top;
        const testimonialsSectionBottom = testimonialsSection.getBoundingClientRect().bottom;
        
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        let newSection = 'hero';
        if (servicesSectionTop <= 100 && servicesSectionBottom >= 100) {
            newSection = 'services';
        } else if (testimonialsSectionTop <= 100 && testimonialsSectionBottom >= 100) {
            newSection = 'testimonials';
        }
        
        if (currentSection !== newSection) {
            let newText = originalBrandText;
            if (newSection === 'services') {
                newText = 'Our Services';
            } else if (newSection === 'testimonials') {
                newText = 'Testimonials';
            }
            updateBrandText(newText);
            currentSection = newSection;
        }
    });
});
