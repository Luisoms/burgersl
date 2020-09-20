// SUMAR O RESTAR

function añadirP() {
  var cantidadP = document.querySelector('.cantidad');

  if (cantidadP.value == 20){
    return false;
  } else{
    cantidadP.value++;
  }
};

function quitarP() {
  var cantidadP = document.querySelector('.cantidad');

  if (cantidadP.value == 1){
    return false;
  } else{
    cantidadP.value--;
  }
};

