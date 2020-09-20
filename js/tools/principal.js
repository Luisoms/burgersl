// CONSTANTES
const body = document.querySelector('.home');

const navbar = document.getElementById('navbar');
const menu = document.querySelector('.menu');
const hamburguesa = document.querySelector('.btnhb');
const link = document.querySelector('.link');


// HAMBURGUESA
let menuOpen = false;

hamburguesa.addEventListener('click', () => {
  if(!menuOpen) {
    menu.classList.add('open');
    menuOpen = true;
  }else {
    menu.classList.remove('open');
    menuOpen = false;
  }
});

document.querySelector('.link').addEventListener('click', () =>{
  menu.classList.remove('open');
  menuOpen = false;
});

navbar.addEventListener('mouseleave', () =>{
  if(menuOpen) {
    menu.classList.remove('open');
    menuOpen = false;
  }
});

// MENU ESCONDIDO
var valorScroll = window.scrollY;

window.addEventListener('scroll', () => {

  if (valorScroll == window.scrollY) {
    navbar.style.transform="translateY(0px)";
  }
  if (window.scrollY > valorScroll) {
    navbar.style.transform="translateY(-80px)";
    menu.classList.remove('open');
    menuOpen = false;
    valorScroll = window.scrollY;
  }
  if (window.scrollY < valorScroll) {
    navbar.style.transform="translateY(0px)";
    menu.classList.remove('open');
    menuOpen = false;
    valorScroll = window.scrollY;
  }
});
 


/* document.getElementById("desactivar").innerHTML = null;
document.getElementById("dialibre").style.display="flex";*/
