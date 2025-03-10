// document.addEventListener("DOMContentLoaded", () => {
//     const shopButton = document.querySelector(".shop-btn");

//     shopButton.addEventListener("click", () => {
//         alert("Redirecting to the shop...");
//         window.location.href = "#"; // Replace with your actual shop URL
//     });
// });

let currentLang = "en"; // Default language is English
        document.getElementById("langToggle").addEventListener("click", function() {
            currentLang = currentLang === "en" ? "km" : "en";
            document.querySelectorAll(".lang").forEach(el => {
                el.textContent = el.getAttribute(`data-${currentLang}`);
            });
            this.textContent = currentLang === "en" ? "ភាសាខ្មែរ" : "English";
        });
        // Rating stars
        const ratings = document.querySelectorAll('.rating');

        ratings.forEach(rating => {
            rating.addEventListener('click', (e) => {
                const stars = rating.querySelectorAll('.star');
                const value = e.target.getAttribute('data-value');

                // Clear previous ratings
                stars.forEach(star => {
                    star.classList.remove('selected');
                });

                // Set the selected stars based on the clicked star
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= value) {
                        star.classList.add('selected');
                    }
                });

                // Set the data-rating attribute
                rating.setAttribute('data-rating', value);
            });
        });
// run text
document.addEventListener("DOMContentLoaded", function () {
    const text = "Get 25% Off On Your First Purchase!";
    const typingText = document.getElementById("typing-text");
    let index = 0;

    function typeEffect() {
        if (index < text.length) {
            typingText.textContent += text[index]; 
            index++;
            setTimeout(typeEffect, 100);
        } else {
            setTimeout(resetText, 3000); 
        }
    }

    function resetText() {
        typingText.textContent = ""; 
        index = 0;
        typeEffect(); 
    }

    typeEffect(); 
});






        