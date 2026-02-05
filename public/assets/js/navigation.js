    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger-btn');
        const navLinks = document.getElementById('nav-links');
        const logo = document.getElementById('logo-container');

        if (hamburger && navLinks) {
            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                hamburger.classList.toggle('toggle');

                if(logo) {
                    logo.classList.toggle('logo-hidden');
                }
            });

            const links = document.querySelectorAll('.nav-links a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                    hamburger.classList.remove('toggle');
                    if(logo) logo.classList.remove('logo-hidden');
                });
            });
        }
    });