const logo = document.querySelector('header .logo');
window.addEventListener('scroll', function(e) {
    let scrollPosition = this.pageYOffset;
    if (scrollPosition >= 100) {
        logo.classList.add('fade');
    } else {
        logo.classList.remove('fade');
    }
});