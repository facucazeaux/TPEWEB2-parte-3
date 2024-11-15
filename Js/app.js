"use strict"

const BASE_URL = "api/"; 

let series = [];


// Referencias a formularios y lista de series
const formSerie = document.querySelector("#serie-form");


// Agregar eventos a los formularios
formSerie.addEventListener('submit', insertSerie);


async function getAll() {
    try {
        const response = await fetch(BASE_URL+"serie");
        if (!response.ok) {
            throw new Error('Error al obtener las series');
        }

        series = await response.json();
        showSeries();
    } catch (error) {
        console.log(error);
    }
}

async function insertSerie(e) {
    e.preventDefault();

    let data = new FormData(formSerie);
    let serie = {
        nombre: data.get('nombre'),
        temporadas: data.get('temporadas'),
        protagonistas: data.get('protagonistas'),
        director: data.get('director'),
        CalificacionPorEdad: data.get('CalificacionPorEdad'),
        resumen: data.get('resumen'),
        id_genero: data.get('id_genero')
    };

    try {
        let response = await fetch(BASE_URL+"serie", {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(serie)
        });
        if (!response.ok) {
            throw new Error('Error del servidor al insertar serie');
        }

        let newSerie = await response.json();
        series.push(newSerie);
        showSeries();

        formSerie.reset();
    } catch (e) {
        console.log(e);
    }
}


async function deleteSerie(e) {
    e.preventDefault();

    let id = e.target.dataset.id;  // Asegúrate de que el enlace tiene el atributo data-id
    try {
        let response = await fetch(BASE_URL + id, { method: 'DELETE' });
        if (!response.ok) {
            throw new Error('Error al eliminar la serie');
        }

        series = series.filter(serie => serie.id != id);
        showSeries();
    } catch (e) {
        console.log(e);
    }
}
function showCategoria() {
    let ul = document.querySelector("#categorias-list");
    ul.innerHTML = "";
    for (const categoria of categorias) {
        let html = `
            <li>
                <span><b>${categoria.id_genero}</b> - ${categoria.genero} - ${categoria.descripcion}</span>
                <div>
                    <a href="#" data-id="${categoria.id_genero}" class="delete-categoria">Borrar</a>
                </div>
            </li>
        `;
        ul.innerHTML += html;
    }

    let count = document.querySelector("#count-categorias");
    count.innerHTML = categorias.length;

    document.querySelectorAll(".delete-categoria").forEach(btn => btn.addEventListener('click', deleteCategoria));
}



function showSerie() {
    let ul = document.querySelector("#categorias-list");
    ul.innerHTML = "";
    for (const serie of series) {
        let html = `
            <li>
                <span><b>${serie.nombre}</b> - ${serie.temporadas} - ${serie.protagonistas}- ${serie.director}- ${serie.CalificacionPorEdad}- ${serie.resumen}- ${serie.id_genero}</span>
                <div>
                    <a href="#" data-id="${serie.id}" class="delete-categoria">Borrar</a>
                </div>
            </li>
        `;
        ul.innerHTML += html;
    }

    let count = document.querySelector("#count");
    count.innerHTML = tasks.length;

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteTask);
    }

    // asigno event listener para los botones
    const btnsFinalizar = document.querySelectorAll('a.btn-finalize');
    for (const btnFinalizar of btnsFinalizar) {
        btnFinalizar.addEventListener('click', finalizeTask);
    }
}



getAll();
