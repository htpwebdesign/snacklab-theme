document.addEventListener("DOMContentLoaded", function() {
    // Select all accordion buttons
    const accordionButtons = document.querySelectorAll(".accordion-btn");

    accordionButtons.forEach(button => {
        button.addEventListener("click", function() {
            // Toggle active class
            this.classList.toggle("active");

            // Select the corresponding accordion content
            const accordionContent = this.nextElementSibling;

            if (accordionContent.style.maxHeight) {
                // If content is open, close it
                accordionContent.style.maxHeight = null;
            } else {
                // If content is closed, open it
                accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
            }
        });
    });
});
