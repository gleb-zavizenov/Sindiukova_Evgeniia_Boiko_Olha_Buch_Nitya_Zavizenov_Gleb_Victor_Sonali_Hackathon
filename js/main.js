







//
// Mobile nav 
//
let mobileNav = document.querySelector('.mobile-nav');
let crossIcon = document.querySelector('.mobile-nav-cross');
let burgerIcon = document.querySelector('.nav-burger');
let mobileLinks = document.querySelectorAll('.mobile-nav-container a');

burgerIcon.addEventListener('click', function(){
    mobileNav.classList.add('mobile-nav-open');
})

crossIcon.addEventListener('click', function(){
    mobileNav.classList.remove('mobile-nav-open');
})

mobileLinks.forEach(link => {
    link.addEventListener('click', function(){
        mobileNav.classList.remove('mobile-nav-open');
    })
})