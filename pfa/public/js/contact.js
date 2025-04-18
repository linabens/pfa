document.addEventListener('DOMContentLoaded', function() {
    // Map initialization (placeholder - would use Google Maps API in production)
    const initMap = function() {
        console.log('Map would be initialized here with Google Maps API');
        // In a real implementation, this would initialize a Google Map
    };
    
    // Initialize map when contact page loads
    if (document.querySelector('.locations-grid')) {
        initMap();
    }
    
    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate form submission
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';
            
            // Simulate API call
            setTimeout(() => {
                submitButton.textContent = 'Message Sent!';
                
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'alert success';
                successMessage.textContent = 'Your message has been sent successfully! We will get back to you soon.';
                contactForm.prepend(successMessage);
                
                // Reset form after 3 seconds
                setTimeout(() => {
                    contactForm.reset();
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                    successMessage.remove();
                }, 3000);
            }, 1500);
        });
    }
});