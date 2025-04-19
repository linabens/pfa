document.addEventListener('DOMContentLoaded', function() {
    // Initialize health chart
    const initHealthChart = function() {
        const ctx = document.getElementById('healthChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
                datasets: [
                    {
                        label: 'Blood Pressure (Systolic)',
                        data: [125, 128, 122, 130, 126, 124, 123, 121, 120, 122, 120],
                        borderColor: '#3a7bd5',
                        backgroundColor: 'rgba(58, 123, 213, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Heart Rate (bpm)',
                        data: [72, 75, 70, 68, 72, 74, 76, 72, 70, 72, 72],
                        borderColor: '#00d2ff',
                        backgroundColor: 'rgba(0, 210, 255, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    };
    
    // Initialize chart if on dashboard
    if (document.getElementById('healthChart')) {
        initHealthChart();
    }
    
    // Notification dropdown
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function() {
            const dropdown = document.createElement('div');
            dropdown.className = 'notification-dropdown';
            dropdown.innerHTML = `
                <div class="notification-header">
                    <h4>Notifications</h4>
                    <span class="badge">3</span>
                </div>
                <div class="notification-list">
                    <div class="notification-item">
                        <div class="notification-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="notification-content">
                            <p>Your appointment with Dr. Lindemann is confirmed for Nov 15.</p>
                            <span class="notification-time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-icon">
                            <i class="fas fa-prescription-bottle-alt"></i>
                        </div>
                        <div class="notification-content">
                            <p>Your prescription refill is ready for pickup.</p>
                            <span class="notification-time">1 day ago</span>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="notification-content">
                            <p>New test results are available in your medical records.</p>
                            <span class="notification-time">3 days ago</span>
                        </div>
                    </div>
                </div>
                <div class="notification-footer">
                    <a href="#">View All Notifications</a>
                </div>
            `;
            
            // Position dropdown
            dropdown.style.position = 'absolute';
            dropdown.style.right = '0';
            dropdown.style.top = 'calc(100% + 10px)';
            
            // Check if dropdown already exists
            const existingDropdown = document.querySelector('.notification-dropdown');
            if (existingDropdown) {
                existingDropdown.remove();
            } else {
                notificationBtn.parentNode.appendChild(dropdown);
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function closeDropdown(e) {
                    if (!notificationBtn.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.remove();
                        document.removeEventListener('click', closeDropdown);
                    }
                });
            }
        });
    }
});