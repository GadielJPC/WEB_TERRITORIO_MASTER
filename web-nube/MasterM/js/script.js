document.addEventListener("DOMContentLoaded", function () {
    const btnMenu = document.getElementById("btn-menu");
    const menu = document.getElementById("menu-principal");

    const btnOferta = document.getElementById("btn-oferta");
    const cajaOferta = document.getElementById("caja-oferta");

    const btnMedicina = document.getElementById("btn-medicina");
    const cajaMedicina = document.getElementById("caja-medicina");

    if (btnMenu && menu) {
        btnMenu.addEventListener("click", function () {
            menu.classList.toggle("abierto");

            if (menu.classList.contains("abierto")) {
                btnMenu.textContent = "×";
            } else {
                btnMenu.textContent = "☰";

                if (cajaOferta) cajaOferta.classList.remove("desplegado");
                if (cajaMedicina) cajaMedicina.classList.remove("desplegado");
            }
        });
    }

    if (btnOferta && cajaOferta) {
        btnOferta.addEventListener("click", function (e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                cajaOferta.classList.toggle("desplegado");

                if (cajaMedicina) {
                    cajaMedicina.classList.remove("desplegado");
                }
            }
        });
    }

    if (btnMedicina && cajaMedicina) {
        btnMedicina.addEventListener("click", function (e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                cajaMedicina.classList.toggle("desplegado");
            }
        });
    }
});