const noIngreso = document.querySelector(".noIngreso");
const noRegristro = document.querySelector(".crear");

const ingresar = document.getElementById("ingresar");
const registrar = document.getElementById("registrar");

const cerrarVentanaI = document.querySelector(".cerrarI");
const cerrarVentanaR = document.querySelector(".cerrarR");

// ENTRAR

function checkIngreso() {
  if (registrar.style.left == "50%") {
    registrar.style.left = "-800px";
  }
  ingresar.style.right = "50%";
};

function ingresarBtn() {
  if (registrar.style.left == "50%") {
    registrar.style.left = "-800px";
  }
  ingresar.style.right = "50%";
};

cerrarVentanaI.addEventListener("click", () => {
  ingresar.style.right = "-800px";
});

ingresar.addEventListener("mouseover", () => {
  mouseVolvioI = true;
});

function validarMouseI(positionI) {
  ingresar.style.right = positionI;
}

ingresar.addEventListener("mouseleave", () => {
  mouseVolvioI = false;
  setTimeout(function () {
    if (mouseVolvioI) {
      validarMouseI("50%");
    } else {
      validarMouseI("-800px");
    }
  }, 1500);
});

window.addEventListener("scroll", () => {
  setTimeout(function () {
    ingresar.style.right = "-800px";
  }, 300);
});

// REGISTRAR

noRegristro.addEventListener("click", () => {
  if (ingresar.style.right == "50%") {
    ingresar.style.right = "-800px";
  }
  registrar.style.left = "50%";
});

function registrarBtn() {
  if (ingresar.style.right == "50%") {
    ingresar.style.right = "-800px";
  }
  registrar.style.left = "50%";
};

cerrarVentanaR.addEventListener("click", () => {
  registrar.style.left = "-800px";
});

registrar.addEventListener("mouseover", () => {
  mouseVolvioR = true;
});

function validarMouseR(positionR) {
  registrar.style.left = positionR;
}

registrar.addEventListener("mouseleave", () => {
  mouseVolvioR = false;
  setTimeout(function () {
    if (mouseVolvioR) {
      validarMouseR("50%");
    } else {
      validarMouseR("-800px");
    }
  }, 1500);
});

window.addEventListener("scroll", () => {
  setTimeout(function () {
    registrar.style.left = "-800px";
  }, 300);
});
