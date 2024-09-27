const btnAddcarrito = document.querySelectorAll(".btnAddcarrito");
const btnCarrito = document.querySelector("#btnCantidadCarrito");
const verCarrito = document.querySelector('#verCarrito');
const tableListaCarrito = document.querySelector('#tableListaCarrito tbody');

let listaCarrito;
document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem("listaCarrito") != null) {
        listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
    }
    for (let i = 0; i < btnAddcarrito.length; i++) {
        btnAddcarrito[i].addEventListener("click", function (e) {
            e.preventDefault();
            let idProducto = btnAddcarrito[i].getAttribute("prod");
            let filePath = btnAddcarrito[i].getAttribute("data-filepath");
            let size = btnAddcarrito[i].getAttribute("data-size");
            let type = btnAddcarrito[i].getAttribute("data-type");
            agregarCarrito(idProducto, 1, filePath, size, type, true);
        });
    }
    cantidadCarrito();

    verCarrito.addEventListener('click', function () {
        getListaCarrito();
        $('#modalCarrito').modal('show')
    })
});

function agregarCarrito(idProducto, cantidad, filePath, size, type, esPersonalizado = false) {
    if (localStorage.getItem("listaCarrito") == null) {
        listaCarrito = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem("listaCarrito"));
        listaCarrito = listaExiste;
    }

    // Generar un ID único para productos personalizados
    if (esPersonalizado) {
        idProducto = idProducto + '_' + Date.now(); // Por ejemplo: 'custom_1632767890'
    }

    // Verificar si el producto ya existe en el carrito (solo para productos no personalizados)
    if (!esPersonalizado) {
        for (let i = 0; i < listaCarrito.length; i++) {
            if (listaCarrito[i]["idProducto"] == idProducto && !listaCarrito[i]["personalizado"]) {
                alertaPerzanalizada("EL PRODUCTO YA ESTÁ AGREGADO", "warning");
                return;
            }
        }
    }

    // Agregar el producto al carrito
    listaCarrito.push({
        idProducto: idProducto,
        cantidad: cantidad,
        imagen: filePath,
        size: size,
        type: type,
        personalizado: esPersonalizado // Aquí indicamos si es personalizado o no
    });

    localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
    alertaPerzanalizada("PRODUCTO AGREGADO AL CARRITO", "success");
    cantidadCarrito();
}


function cantidadCarrito() {
    let listas = JSON.parse(localStorage.getItem("listaCarrito"));
    if (listas != null) {
        btnCarrito.textContent = listas.length;
    } else {
        btnCarrito.textContent = 0;
    }
}

function getListaCarrito() {
    const url = base_url + 'principal/listaProductos';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.setRequestHeader('Content-Type', 'application/json'); // Asegúrate de establecer el tipo de contenido
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.productos.forEach(producto => {
                if (producto.personalizado) {
                    // Renderizar producto personalizado
                    html += `<tr>
                        <td><img class="img-thumbnail" src="${base_url + producto.imagen}" alt="" width="100"></td>
                        <td>Producto personalizado (${producto.size}, ${producto.type})</td>
                        <td><span class="badge bg-warning">${res.moneda + ' ' + producto.precio}</span></td>
                        <td width="100">
                        <input type="number" class="form-control agregarCantidad" id="${producto.idProducto}" value="${producto.cantidad}">
                        </td>
                        <td>${producto.subTotal}</td>
                        <td><button class="btn btn-danger btnDeletecart" type="button" prod="${producto.idProducto}"><i class="fas fa-times-circle"></i></button></td>
                    </tr>`;
                } else {
                    // Renderizar producto normal
                    html += `<tr>
                        <td><img class="img-thumbnail" src="${base_url + producto.imagen}" alt="" width="100"></td>
                        <td>${producto.nombre}</td>
                        <td><span class="badge bg-warning">${res.moneda + ' ' + producto.precio}</span></td>
                        <td width="100">
                        <input type="number" class="form-control agregarCantidad" id="${producto.idProducto}" value="${producto.cantidad}">
                        </td>
                        <td>${producto.subTotal}</td>
                        <td><button class="btn btn-danger btnDeletecart" type="button" prod="${producto.idProducto}"><i class="fas fa-times-circle"></i></button></td>
                    </tr>`;
                }
            });
            tableListaCarrito.innerHTML = html;
            document.querySelector('#totalGeneral').textContent = res.total;
            btnEliminarCarrito();
            cambiarCantidad();
        }
    }
}


function btnEliminarCarrito() {
    let listaEliminar = document.querySelectorAll('.btnDeletecart');
    for (let i = 0; i < listaEliminar.length; i++) {
        listaEliminar[i].addEventListener('click', function () {
            let idProducto = listaEliminar[i].getAttribute('prod');
            eliminarListaCarrito(idProducto);
        })
    }
}

function eliminarListaCarrito(idProducto) {
    listaCarrito = listaCarrito.filter(producto => producto.idProducto !== idProducto);
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
    getListaCarrito();
    cantidadCarrito();
    alertaPerzanalizada("PRODUCTO ELIMINADO DEL CARRITO", "success");
}


function cambiarCantidad() {
    let listaCantidad = document.querySelectorAll('.agregarCantidad');
    for (let i = 0; i < listaCantidad.length; i++) {
        listaCantidad[i].addEventListener('change', function () {
            let idProducto = listaCantidad[i].id;
            let cantidad = listaCantidad[i].value
            incrementarCantidad(idProducto, cantidad);
        })
    }
}

function incrementarCantidad(idProducto, cantidad) {
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]['idProducto'] === idProducto) {
            listaCarrito[i].cantidad = cantidad;
            break;
        }
    }
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
}
