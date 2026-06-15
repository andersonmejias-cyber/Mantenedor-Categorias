document.addEventListener('DOMContentLoaded', () => {
    listarCategorias();

    const formCategoria = document.getElementById('form-categoria');

    if (formCategoria) {
        formCategoria.addEventListener('submit', async (event) => {
            event.preventDefault();

            const nombre = document.getElementById('nombre').value.trim();

            if (nombre === '') {
                mostrarMensaje('Debe ingresar el nombre de la categoría.', 'error');
                return;
            }

            await insertarCategoria(nombre);
        });
    }
});

async function listarCategorias() {
    const tablaCategorias = document.getElementById('tabla-categorias');

    if (!tablaCategorias) {
        return;
    }

    try {
        const respuesta = await fetch(BASE_URL + 'api/categorias/listar.php');
        const resultado = await respuesta.json();

        tablaCategorias.innerHTML = '';

        if (!resultado.success) {
            tablaCategorias.innerHTML = `
                <tr>
                    <td colspan="4">No se pudieron cargar las categorías.</td>
                </tr>
            `;
            return;
        }

        if (resultado.data.length === 0) {
            tablaCategorias.innerHTML = `
                <tr>
                    <td colspan="4">No existen categorías registradas.</td>
                </tr>
            `;
            return;
        }

        resultado.data.forEach(categoria => {
            const fila = document.createElement('tr');

            const estadoTexto = categoria.activo == 1 ? 'Activo' : 'Inactivo';
            const estadoClase = categoria.activo == 1 ? 'estado-activo' : 'estado-inactivo';

            const botonTexto = categoria.activo == 1 ? 'Desactivar' : 'Activar';
            const botonClase = categoria.activo == 1 ? 'btn-warning' : 'btn-success';

            fila.innerHTML = `
                <td>${categoria.id}</td>

                <td>${limpiarHTML(categoria.nombre)}</td>

                <td>
                    <span class="badge-estado ${estadoClase}">
                        ${estadoTexto}
                    </span>
                </td>

                <td>
                    <button 
                        type="button" 
                        class="btn-tabla ${botonClase}"
                        onclick="cambiarEstado(${categoria.id})"
                    >
                        ${botonTexto}
                    </button>
                </td>
            `;

            tablaCategorias.appendChild(fila);
        });

    } catch (error) {
        console.error(error);

        tablaCategorias.innerHTML = `
            <tr>
                <td colspan="4">Error al conectar con el servidor.</td>
            </tr>
        `;
    }
}

async function insertarCategoria(nombre) {
    try {
        const respuesta = await fetch(BASE_URL + 'api/categorias/insertar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nombre: nombre
            })
        });

        const resultado = await respuesta.json();

        if (resultado.success) {
            mostrarMensaje(resultado.message || 'Categoría agregada correctamente.', 'exito');

            document.getElementById('form-categoria').reset();

            listarCategorias();
        } else {
            mostrarMensaje(resultado.message || 'No se pudo agregar la categoría.', 'error');
        }

    } catch (error) {
        console.error(error);
        mostrarMensaje('Error al conectar con el servidor.', 'error');
    }
}

async function cambiarEstado(id) {
    try {
        const respuesta = await fetch(BASE_URL + 'api/categorias/cambiar_estado.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id
            })
        });

        const resultado = await respuesta.json();

        if (resultado.success) {
            if (resultado.nuevo_estado == 1) {
                mostrarMensaje('Categoría activada correctamente.', 'exito');
            } else {
                mostrarMensaje('Categoría desactivada correctamente.', 'exito');
            }

            listarCategorias();
        } else {
            mostrarMensaje(resultado.message || 'No se pudo cambiar el estado.', 'error');
        }

    } catch (error) {
        console.error(error);
        mostrarMensaje('Error al conectar con el servidor.', 'error');
    }
}

function mostrarMensaje(texto, tipo) {
    const mensaje = document.getElementById('mensaje-sistema');

    if (!mensaje) {
        return;
    }

    mensaje.textContent = texto;

    if (tipo === 'exito') {
        mensaje.className = 'mensaje-sistema mensaje-exito';
    } else {
        mensaje.className = 'mensaje-sistema mensaje-error';
    }

    mensaje.style.display = 'block';

    setTimeout(() => {
        mensaje.style.display = 'none';
    }, 3500);
}

function limpiarHTML(texto) {
    return String(texto)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}