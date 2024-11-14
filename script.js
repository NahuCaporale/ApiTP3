"use strict";
const BASE_URL = "http://localhost/web2/TPEWEB2/TPEWEB2/rating-movies/api/";
let peliculas = [];
let categorias = [];

let formPelis = document.querySelector("#formPelis");
formPelis.addEventListener("submit", postPeli);

let formCategorias = document.querySelector("#formCategorias");
formCategorias.addEventListener("submit", postCategoria);

let sort = "";
// escuchar cambios en el select
document.getElementById("sortby").addEventListener("change", (e) => {
  sort = e.target.value; // toma el option de el select
  getAll(); // 
});

async function getAll() {
  try {
    let response;
    switch (sort) {
      case "titulo":
        response = await fetch(BASE_URL + "peliculas?orderBy=titulo");
        break;
      default:
        response = await fetch(BASE_URL + "peliculas");
        break;
    }
    if (!response.ok) {
      throw new Error("Error al obtener peliculas");
    }
    peliculas = await response.json();
    showPeliculas();
  } catch (error) {
    console.log(error);
  }
}

async function postPeli(e) {
  e.preventDefault();

  let data = new FormData(formPelis);
  let peli = {
    titulo: data.get("titulo"),
    categoria_id: data.get("categoria_id"),
    imagen: data.get("imagen"),
  };
  try {
    let response = await fetch(BASE_URL + "peliculas", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(peli),
    });
    if (!response.ok) {
      throw new Error("Error del server");
    }

    let peliN = await response.json();
    peliculas.push(peliN);
    showPeliculas();
    formPelis.reset();
  } catch (error) {
    console.log(error);
  }
}

async function postCategoria(e) {
  e.preventDefault();

  let data = new FormData(formCategorias);
  let cat = {
    nombre: data.get("nombre"),
    descripcion: data.get("descripcion"),
  };
  try {
    let response = await fetch(BASE_URL + "categorias", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(cat),
    });
    if (!response.ok) {
      throw new Error("Error del server");
    }
    let categoriaNueva = await response.json();
    categorias.push(categoriaNueva);
    showPeliculas();
    cargarCategorias();
    formCategorias.reset();
  } catch (error) {
    console.log(error);
  }
}

function showPeliculas() {
  // obtengo el container de las pelis
  let divPelis = document.querySelector("#peliculas");

  if (divPelis) {
    divPelis.innerHTML = "";

    // buscar los nombres de la categoria
    for (const peli of peliculas) {
      let categoriaNombre = "Categoría no encontrada"; // defecto

      // buscar la categoría en el arreglo de categorías
      for (const categoria of categorias) {
        if (categoria.id === peli.categoria_id) {
          categoriaNombre = categoria.nombre;
          break; //si se encuentra rompe
        }
      }

      //tomamos el nombre e la cat
      peli.categoriaNombre = categoriaNombre;

      // card peli
      let html = `
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card bg-transparent">
                <div class="card-img-container" style="height: 400px; overflow: hidden;">
                    <img 
                        src="${peli.imagen}" 
                        class="card-img-top" 
                        alt="Imagen de ${peli.titulo}"
                        style="width: 100%; height: 100%; object-fit: contain;"
                    >
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <a class="catStyle text-decoration-none text-reset">
                            ${peli.titulo}
                        </a>
                    </h5>
                    <h5 class="card-title">Cat:
                        <a class="catStyle text-decoration-none text-reset">
                            ${peli.categoriaNombre}  <!-- Usamos categoriaNombre que ahora está en peli -->
                        </a>
                    </h5>
                </div>
            </div>
        </div>
      `;

      divPelis.innerHTML += html;
    }
  } else {
    console.error('El elemento con id "peliculas" no se encontró.');
  }
}

async function cargarCategorias() {
  try {
    const response = await fetch(BASE_URL + "categorias");
    if (!response.ok) {
      throw new Error("Error al obtener categorías");
    }
    categorias = await response.json();

    // select de categorias para agregar una peli
    const selectCat = document.getElementById("selectCat");

    selectCat.innerHTML = "";

    // option de el select
    categorias.forEach((categoria) => {
      const option = document.createElement("option");
      option.value = categoria.id;
      option.textContent = categoria.nombre;
      selectCat.appendChild(option);
    });
  } catch (error) {
    console.log(error);
  }
}

// cargar categorias cuando se carga toda lapag
document.addEventListener("DOMContentLoaded", cargarCategorias);

getAll();
