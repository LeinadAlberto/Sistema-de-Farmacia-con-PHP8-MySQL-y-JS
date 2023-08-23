$(document).ready(function() {
    Contar_productos();
    RecuperarLS_carrito();

    /* Funciónes de Administrar Compra */
    RecuperarLS_carrito_compra();
    /* =============================== */

    $(document).on('click', '.agregar-carrito', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const concentracion = $(elemento).attr('prodConcentracion');
        const adicional = $(elemento).attr('prodAdicional');
        const precio = $(elemento).attr('prodPrecio');
        const laboratorio = $(elemento).attr('prodLaboratorio');
        const tipo = $(elemento).attr('prodTipo');
        const presentacion = $(elemento).attr('prodPresentacion');
        const avatar = $(elemento).attr('prodAvatar');
        const stock = $(elemento).attr('prodStock');
        
        const producto = {
            id: id,
            nombre: nombre,
            concentracion: concentracion,
            adicional: adicional,
            precio: precio,
            laboratorio: laboratorio,
            tipo: tipo,
            presentacion: presentacion,
            avatar: avatar,
            stock: stock,
            cantidad: 1
        };

        let id_producto;
        let productos;
        productos = RecuperarLS(); /* Retorna un Array de Objetos JS */
        productos.forEach(prod => {
            if (prod.id === producto.id) {
                id_producto = prod.id;
            }
        });
        if (id_producto === producto.id) {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda...',
                text: 'Ya enviaste al carrito este producto!',
            });
        } else {
            template = `
                <tr prodId="${producto.id}">
                    <td>${producto.id}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.concentracion}</td>
                    <td>${producto.adicional}</td>
                    <td>${producto.precio}</td>
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#lista').append(template);
            /* Función que permitira agregar un producto al Local Storage */
            AgregarLS(producto);
            Contar_productos();
        }
    });

    $(document).on('click', '.borrar-producto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        elemento.remove();
        Eliminar_producto_LS(id);
        Contar_productos();
    });

    $(document).on('click', '#vaciar-carrito', (e) => {
        $('#lista').empty();
        EliminarLS();
        Contar_productos();
    });

    $(document).on('click', '#procesar-pedido', (e) => {
        Procesar_pedido();
    })

    function RecuperarLS() {
        let productos;
        if (localStorage.getItem('productos') === null) {
            productos = [];
        } else {
            productos = JSON.parse(localStorage.getItem('productos'));
        }
        return productos;
    }

    function AgregarLS(producto) {
        let productos;
        productos = RecuperarLS();
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    function RecuperarLS_carrito() {
        let productos;
        productos = RecuperarLS();
        productos.forEach(producto => {
            template = `
                <tr prodId="${producto.id}">
                    <td>${producto.id}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.concentracion}</td>
                    <td>${producto.adicional}</td>
                    <td>${producto.precio}</td>
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#lista').append(template);
        });
    }

    function Eliminar_producto_LS(id) {
        let productos;
        productos = RecuperarLS();
        productos.forEach(function(producto, indice){
            if (producto.id === id) {
                productos.splice(indice,1);
            }
        });
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    function EliminarLS() {
        localStorage.clear();
    }

    function Contar_productos() {
        let productos;
        let contador = 0;
        productos = RecuperarLS();
        productos.forEach(producto => {
            contador = contador + 1;
        });
        $('#contador').html(contador);
    }

    function Procesar_pedido() {
        let productos;
        productos = RecuperarLS();
        if (productos.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Tienes que agregar productos al carrito',
                text: 'El carrito esta vacio!'
            });
        } else {
            location.href = '../vista/adm_compra.php';
        }
    }

    /* Eventos y Funciones para Administrar Compra */
    function RecuperarLS_carrito_compra() {
        let productos;
        productos = RecuperarLS();
        productos.forEach(producto => {
            template = `
                <tr prodId="${producto.id}">
                    <td>${producto.nombre}</td>
                    <td>${producto.stock}</td>
                    <td>${producto.precio}</td>
                    <td>${producto.concentracion}</td>
                    <td>${producto.adicional}</td>
                    <td>${producto.laboratorio}</td>
                    <td>${producto.presentacion}</td>
                    <td>
                        <input type="number" min="1" class="form-control cantidad_producto" value="${producto.cantidad}">
                    </td>
                    <td class="subtotales">
                        <h5>${producto.precio * producto.cantidad}</h5>
                    </td>

                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#lista-compra').append(template);
        });
    }

    $('#cp').keyup((e) => {
        let id, cantidad, producto, productos, montos;
        producto = $(this)[0].activeElement.parentElement.parentElement; /* Selecciona el elemento <tr></tr> */
        console.log(producto);
        id = $(producto).attr('prodId');
        console.log(id);
        cantidad = producto.querySelector('input').value; /* Obtiene el valor que se ingresa en el input */
        console.log(cantidad);
        montos = document.querySelectorAll('.subtotales'); /* NodeList con todos los subtotales */
        console.log(montos);
        productos = RecuperarLS();
        console.log(productos); /* Array de Objetos */
        productos.forEach(function(prod, indice) {
            console.log(prod);
            console.log(indice);
            if (prod.id === id) {
                prod.cantidad = cantidad;
                montos[indice].innerHTML = `<h5>${cantidad * productos[indice].precio}<h5>`;
            }
        });
        localStorage.setItem('productos', JSON.stringify(productos));
    });
});