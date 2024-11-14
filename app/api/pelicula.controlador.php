<?php
require_once "./app/models/categorias.modelo.php";
require_once "./app/models/pelicula.modelo.php";
require_once "./app/view/json.view.php";



class peliculaControlador
{
    private $modeloPel;
    private $modeloCat;

    private $vista;

    function __construct()
    {

        $this->vista = new  JSONView();
        $this->modeloPel = new peliculaModelo();
        $this->modeloCat = new categoriasModelo();
    }


    public function getAll($req)
    {
        $peliculas = [];
        $orderBy = false;
        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }
        $peliculas = $this->modeloPel->getPeliculas($orderBy);

        return $this->vista->response($peliculas);
    }


    //obtiene la peli de el modelo y su respectiva categoria  y las muestra
    public function get($req)
    {
        // Verifica si hay un id
        if (empty($req->params->id)) {
            return $this->vista->response("no hay pelicula con ese id", 404);
        }
        $id = $req->params->id;
        // Lógica para obtener peli por número
        $peli = $this->modeloPel->getPelicula($id);
        if (!$peli) {
            return $this->vista->response("No hay una pelicula con ese id", 404);
        }
        return $this->vista->response($peli);
    }
    public function delete($req, $res)
    {
        // Verifica si hay un id
        if (empty($req->params->id)) {
            return $this->vista->response("no hay Pelicula con ese id", 404);
        }
        $id = $req->params->id;
        $peli = $this->modeloPel->getPelicula($id);
        if (!$peli) {
            return $this->vista->response("No existe el id", 404);
        }
        $this->modeloPel->delete($id);
        return $this->vista->response("La Pelicula $id se elimino");
    }
    public function crear($req, $res)
    {
        if (empty($req->body->titulo) && empty($req->body->categoria_id)) {
            return $this->vista->response("Llenar todos los datos", 400);
        }
        $titulo = $req->body->titulo;
        $categoria = $req->body->categoria_id;
        if (!isset($req->body->imagen)) {
            $imagen = '';
        } else {
            $imagen = $req->body->imagen;
        }
        $id = $this->modeloPel->crear($titulo, $categoria,$imagen);
        if (!$id) {
            return $this->vista->response("No se pudo crear", 500);
        }
        $pelicula = $this->modeloPel->getPelicula($id);
        return $this->vista->response($pelicula, 201);
    }
    public function editar($req, $res)
    {
        if (!isset($req->params->id)) {
            return $this->vista->response("No existe la pelicula a editar", 404);
        }
        $id = $req->params->id;


        if (empty($req->body->titulo) || empty($req->body->categoria)) {
            return $this->vista->response("Llenar todos los datos", 400);
        }
        $titulo = $req->body->titulo;
        $categoria = $req->body->categoria;
        $imagen = $req->body->imagen;
        $this->modeloPel->editar($id, $titulo, $categoria,$imagen);
        $peli = $this->modeloPel->getPelicula($id);
        return $this->vista->response($peli);
    }
}
