
document.addEventListener('DOMContentLoaded', () => {
    // Add hover effects for stats
    const stats = document.querySelectorAll('.stat');
    stats.forEach(stat => {
        stat.addEventListener('mouseenter', () => {
            stat.classList.add('hovered');
            stat.querySelector('h3').classList.add('text-warning');
            stat.querySelector('h6').classList.add('text-success');
            const img = stat.querySelector('.icon-overlay img');
            if (img) {
                img.style.transform = 'scale(1.2) rotate(10deg)';
            }
        });
        stat.addEventListener('mouseleave', () => {
            stat.classList.remove('hovered');
            stat.querySelector('h3').classList.remove('text-warning');
            stat.querySelector('h6').classList.remove('text-success');
            const img = stat.querySelector('.icon-overlay img');
            if (img) {
                img.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });
  
    // Count Up Animation
    function animateCountUp(element, start, end, duration) {
        let startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            let progress = timestamp - startTime;
            let current = Math.min(start + (progress / duration) * (end - start), end);
            element.innerText = `${Math.floor(current)}+`; 
            if (current < end) {
                requestAnimationFrame(step);
            }
        }
        requestAnimationFrame(step);
    }

    function startAnimation() {
        const stats = [
            { element: document.querySelector("#owned-products"), value: 5000 },
            { element: document.querySelector("#curated-products"), value: 800 },
            { element: document.querySelector("#product-categories"), value: 20 }
        ];

        stats.forEach(stat => {
            animateCountUp(stat.element, 0, stat.value, 2000);
        });
    }

    // Run animation based on screen size
    function checkScreenSize() {
        const screenWidth = window.innerWidth;
        if (screenWidth <= 768) {
            startAnimation();
        } else {
            const statsSection = document.querySelector(".stats");
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    startAnimation();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe(statsSection);
        }
    }

    checkScreenSize();
    window.addEventListener("resize", checkScreenSize); // Check on resize
});

// Image Swap for profileImg
document.addEventListener("DOMContentLoaded", function () {
    const images = [
        "views/assets/about-images/shoppingcard1.png",
        "views/assets/about-images/shoping.png",
        "views/assets/about-images/shoppingcard2.png"
    ];
    let index = 0;
    const profileImg = document.getElementById("profileImg");

    function swapImage() {
        index = (index + 1) % images.length;
        profileImg.src = images[index];
    }

    setInterval(swapImage, 2000); // Change image every 2 seconds
});

document.addEventListener('DOMContentLoaded', () => {
    const cardLinks = document.querySelectorAll('.shop-card-link');
    const viewMoreBtn = document.querySelector('.view-more-btn');

    // Navigation for each card
    cardLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const category = link.querySelector('.card-title').textContent.toLowerCase().replace(/\s+/g, '-');
            window.location.href = `${category}.html`; // Example: "beverages.html"
            console.log(`Navigating to ${category}.html`);
        });
    });

    // Navigation for "View More" button
    if (viewMoreBtn) {
        viewMoreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = 'all-categories.html'; // Replace with your all-categories page
            console.log('Navigating to all-categories.html');
        });
    }
});