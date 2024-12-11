document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            console.log('Anchor clicked:', this.getAttribute('href')); // Debugging line
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                console.error('Target not found:', targetId); // Log if target is not found
            }
        });
    });
});