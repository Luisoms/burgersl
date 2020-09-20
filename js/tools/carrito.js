const btnCarrito = document.querySelector('.btncarrito');
const carrito = document.getElementById("carrito");

const cerrarCarrito = document.querySelector('.cerrarC');

function carritoBtn() {
    carrito.style.right="50%";
};

cerrarCarrito.addEventListener("click", () => {
    carrito.style.right = "-1000px";
});
  
  carrito.addEventListener("mouseover", () => {
    mouseVolvioC = true;
});
  
function validarMouseC(positionI) {
    carrito.style.right = positionI;
}
  
carrito.addEventListener("mouseleave", () => {
    mouseVolvioC = false;
    setTimeout(function () {
      if (mouseVolvioC) {
        validarMouseC("50%");
      } else {
        validarMouseC("-1000px");
      }
    }, 1500);
});
  
window.addEventListener("scroll", () => {
    setTimeout(function () {
        carrito.style.right = "-1000px";
    }, 300);
});

// MOSTRAR PRODUCTO

/* function productoC(pId){
    document.getElementById('carrito').style.right="50%";
    var requestId = $.ajax({
        method: "POST",
        url: "productos.php",
        data: {'p_id' : pId}
    })
    requestId.done(function(pCarrito) {
      $('.productos').html(pCarrito)
    });
};
 */
// AÑADIR A LA CESTA

/* function enviarCesta(apId){
  cantidadC == $('#cantidadC');

  $.ajax({
    method: "POST",
    url: "carrito.php",
    data: {'accion' : 'añadir', 'p_id': apId, 'cantidad': cantidadC.value}
  })
  .done( function(resultado){
    $("#cesta").html(resultado);
  });
};
 */
/* function borrarCesta(bpId){
  $.ajax({
    method: "POST",
    url: "cesta.php",
    data: {'accion' : 'borrar', 'p_id': bpId}
  })
  .done(function(borrar){
    $('#cesta').html(borrar);
  });
};

function comprarCesta(){
  $.ajax({
    method: "POST",
    url: "cesta.php",
    data: {'accion' : 'comprar'}
  });
}; */