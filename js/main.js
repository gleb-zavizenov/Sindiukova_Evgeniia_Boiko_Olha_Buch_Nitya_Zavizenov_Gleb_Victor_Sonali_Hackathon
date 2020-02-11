// importing all components
import SignupComponent from './components/SignupComponent.js';
import UpdateComponent from './components/UpdateComponent.js';

// these are the same as Express routes -> router.get('/', ...)
const routes = [
    { path: '/', name:'signup', component: SignupComponent},
    { path: '/update', name:'update', component: UpdateComponent}
]

const router = new VueRouter({
    routes
})

const vm = new Vue({
    el: "#app",
    data: {},
    methods: {},
    router
})


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