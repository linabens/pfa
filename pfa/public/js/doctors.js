document.addEventListener('DOMContentLoaded', function() {
    // Filter doctors by specialty
    const filterButtons = document.querySelectorAll('.filter-btn');
    const doctorCards = document.querySelectorAll('.doctor-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            // Filter doctor cards
            doctorCards.forEach(card => {
                if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Doctor card hover effect
    doctorCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const socialIcons = this.querySelector('.doctor-social');
            if (socialIcons) {
                socialIcons.style.opacity = '1';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const socialIcons = this.querySelector('.doctor-social');
            if (socialIcons) {
                socialIcons.style.opacity = '0';
            }
        });
    });
});