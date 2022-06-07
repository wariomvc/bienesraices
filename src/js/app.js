document.addEventListener('DOMContentLoaded',function(){
    console.log("entro")
    eventListeners();
    darkModeListener();
})

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', mobileMenuClick)
};

function mobileMenuClick(){
    console.log("holas");
    const navegacion = document.querySelector('.navegacion');
    console.log(navegacion);
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
}

function darkModeListener(){
    const botonDarkMode = document.querySelector('.boton-dark');
    botonDarkMode.addEventListener('click',function(){
        document.body.classList.toggle('dark-mode');
    })
}