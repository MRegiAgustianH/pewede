
    const backToTopButton = document.querySelector('.back-to-top');
    const footer = document.querySelector('footer');
        
    window.addEventListener('scroll', () => {
    if (window.pageYOffset > 500 || 
        footer.getBoundingClientRect().top < window.innerHeight) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });






    


    