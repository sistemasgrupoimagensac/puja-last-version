let profile = document.querySelector('.profile');
let menu = document.querySelector('.menu');

if (profile){
    profile.onclick = function () {
        menu.classList.toggle('active');
    }
}


/* const tap = document.querySelector('.profile');
    tap.addEventListener('click', function(){
        const toggleMenu = document.querySelector('.menu');
    toggleMenu.classList.toggle('active');
}); */