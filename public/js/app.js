document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const twoWeeksLater = new Date();
    twoWeeksLater.setDate(today.getDate() + 14);

    // Initial simple date picker restriction already done by min/max in HTML
    
    // If we want to dynamically show booked dates, we need an API.
    // For now, let's just make the date picker nice and big.
});
